<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Post;
use App\Category;
use App\Tag;

use App\Http\Controllers\Controller;

class DashbordController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
    	$post=Post::all();
     	$populer_post=Post::withCount('comments')
    	                   ->withCount('favorite_to_users')
    	                   ->orderBy('view_count','desc')
    	                   ->orderBy('comments_count','desc')
    	                   ->orderBy('favorite_to_users_count','desc')
    	                   ->take(5)->get();

          $pending_post=Post::where('is_aproved',false)->count();
          $all_view=$post->sum('view_count'); 
          $author_count=User::where('role_id',2)->count();
          $new_user_add=User::where('role_id',2)
                              ->whereDate('created_at',Carbon::today())->count();
        /*akhana scope use kora hoysa user model ar moddha "schopAuthor"*/                      
           $active_user=User::authors()
                             ->withCount('posts')
                             ->withCount('comments')
                             ->withCount('favorite_to_posts')
                             ->orderBy('posts_count','desc')
                             ->orderBy('comments_count','desc')
                             ->orderBy('favorite_to_posts_count','desc')  
                             ->get();
        $catrgoty_count=Category::all()->count();
        $tag_count=Tag::all()->count();
                                               
    	return view('admin.dashbord',compact('post','populer_post','pending_post','all_view','author_count','new_user_add','active_user','catrgoty_count','tag_count'));
    }
    
}
