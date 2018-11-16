<?php

namespace App\Http\Controllers\Author;

use App\post;
use App\Tag;
use App\User;
use App\Category;
use App\Notifications\NewAuthorPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $post=Auth::user()->posts()->latest()->get();
        return view('author.post.index',compact('post'));
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
         return view('author.post.postcreat',compact('category','tag'));
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
        $post->is_aproved=false;
        $post->save();

        $post->tags()->attach($request->tag);
        $post->categores()->attach($request->category);

        /*notification*/
        $users=User::where('role_id','1')->get();
        Notification::send($users,new NewAuthorPost($post));

        Toastr::success('post Successfully created:)' ,'Success');
        return redirect()->route('author.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        if ($post->user_id != Auth::id())
        {
            Toastr::error('you can not asses this post' ,'Error');
           return redirect()->back();
        }
         return view('author.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        if ($post->user_id != Auth::id())
        {
            Toastr::error('you can not asses this post' ,'Error');
           return redirect()->back();
        }
        $category=Category::all();
        $tag=Tag::all();
        return view('author.post.edit',compact('post','category','tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post)
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
        $post->is_aproved=false;
        $post->save();

        $post->tags()->sync($request->tag);
        $post->categores()->sync($request->category);
        Toastr::success('post Successfully update:)' ,'Success');
        return redirect()->route('author.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        if ($post->user_id != Auth::id())
        {
            Toastr::error('You are not authorized to access this post','Error');
            return redirect()->back();
        }
        if (Storage::disk('public')->exists('post/'.$post->image))
        {
            Storage::disk('public')->delete('post/'.$post->image);
        }
        $post->categores()->detach();
        $post->tags()->detach();
        $post->delete();
        Toastr::success('Post Successfully Deleted :)','Success');
        return redirect()->back();

    }

}
