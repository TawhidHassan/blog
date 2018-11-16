<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Tag;
use App\Category;
use App\Subscriber;
use App\Notifications\AuthorPostApproved;
use App\Notifications\NewPostNotify;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post= Post::latest()->get();
        return view('admin.post.index',compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category=Category::all();
        $tag=Tag::all();
         return view('admin.post.postcreat',compact('category','tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
           'title' => 'required',
           'image' => 'required|image',
           'category' => 'required',
           'tag' => 'required',
           'body' => 'required',

        ]);
       $image = $request->file('image');
        $slug = str_slug($request->title);
        if (isset($image))
        {
//            make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
//            check category dir is exists
            if (!Storage::disk('public')->exists('post'))
            {
                Storage::disk('public')->makeDirectory('post');
            }
//            resize image for category and upload
            $post = Image::make($image)->resize(1600,1066)->stream();
            Storage::disk('public')->put('post/'.$imagename,$post);
        } else {
            $imagename = "default.png";
        }

        $post=new Post();
        $post->user_id=Auth::id();
        $post->title=$request->title;
        $post->slug=$slug;
        $post->image=$imagename;
        $post->body=$request->body;
        if(isset($request->statas))
        {
            $post->statas=true;
        }
        else{
            $post->statas=false;
        }
        $post->is_aproved=true;
        $post->save();

        $post->tags()->attach($request->tag);
        $post->categores()->attach($request->category);

        // notify
        $subscriber=Subscriber::all();
        foreach ($subscriber as $subscriber) {
            Notification::route('mail',$subscriber->email)
                               ->notify(new NewPostNotify($post));
        }


        Toastr::success('post Successfully Saved :)' ,'Success');
        return redirect()->route('admin.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $category=Category::all();
        $tag=Tag::all();
        return view('admin.post.edit',compact('post','category','tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request,[
           'title' => 'required',
           'image' => 'image',
           'category' => 'required',
           'tag' => 'required',
           'body' => 'required',

        ]);
       $image = $request->file('image');
        $slug = str_slug($request->name);
        if (isset($image))
        {
//            make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
//            check category dir is exists
            if (!Storage::disk('public')->exists('post'))
            {
                Storage::disk('public')->makeDirectory('post');
            }

            /*old pic delet*/
            if (Storage::disk('public')->exists('post/'.$post->image))
            {

                Storage::disk('public')->delete('post/'.$post->image);
            }
//            resize image for category and upload
            $postImage = Image::make($image)->resize(1600,1066)->stream();
            Storage::disk('public')->put('post/'.$imagename,$postImage);
        } else {
            $imagename =$post->image;
        }

       
        $post->user_id=Auth::id();
        $post->title=$request->title;
        $post->slug=$slug;
        $post->image=$imagename;
        $post->body=$request->body;
        if(isset($request->statas))
        {
            $post->statas=true;
        }
        else{
            $post->statas=false;
        }
        $post->is_aproved=true;
        $post->save();

        $post->tags()->sync($request->tag);
        $post->categores()->sync($request->category);
        Toastr::success('post Successfully update:)' ,'Success');
        return redirect()->route('admin.post.index');
    }

    /*panding post*/
     public function panding()
     {
        $post=Post::where('is_aproved',false)->get();
        return view('admin.post.panding',compact('post'));
     }
     public function approve($id)
     {
        $post=Post::find($id);
        $post->is_aproved=true;
        $post->save();

        /*notifyctaion for author*/ 
        $post->user->notify(new AuthorPostApproved($post));
        /*notifyctaion for suscriber*/
         $subscriber=Subscriber::all();
        foreach ($subscriber as $subscriber) {
            Notification::route('mail',$subscriber->email)
                               ->notify(new NewPostNotify($post));
        }


        Toastr::success('post Successfully approve:)' ,'Success');
        return redirect()->route('admin.post.index');
     }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (Storage::disk('public')->exists('post/'.$post->image))
        {
            Storage::disk('public')->delete('post/'.$post->image);
        }
        $post->categores()->detach();
        $post->tags()->detach();
        $post->delete();
        Toastr::success('post Successfully Deleted :)','Success');
        return redirect()->back();
    }
}
