<?php

namespace App\Http\Controllers;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
	public function details($slug)
	{
      $post= Post::where('slug',$slug)->approved()->publish()->first();
      /*view count*/
      $blogkey='blog_'.$post->id;
      if(!Session::has($blogkey))
      {
      	$post->increment('view_count');
      	Session::put($blogkey,1);
      }
     /*view count*/
       $randompost=Post::approved()->publish()->take(3)->inRandomOrder()->get();
       return view('post',compact('post','randompost'));
	}
/*--------------------------------------------------------------*/
	public function index()
	{
		$posts=Post::latest()->approved()->publish()->paginate(6);
		return view('posts',compact('posts'));
	}
/*--------------------------------------------------------------*/
public function postbycategory($slug)
      {
         $category=Category::where('slug',$slug)->first();
         $posts=$category->posts()->approved()->publish()->get();
         return view('categorypost',compact('category','posts'));
            
      }

      public function postbytag($slug)
      {
         $tags=Tag::where('slug',$slug)->first();
         $posts=$tags->posts()->approved()->publish()->get();
         return view('tagbypost',compact('tags','posts'));
            
      }
}
