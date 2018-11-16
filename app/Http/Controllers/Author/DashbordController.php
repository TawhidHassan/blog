<?php

namespace App\Http\Controllers\Author;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashbordController extends Controller
{
    public function index(){

    	$user=Auth::user();
    	$post=$user->posts;
    	$popular_post=$user->posts()
    	                   ->withCount('comments')
    	                   ->withCount('favorite_to_users')
    	                   ->orderBy('view_count','desc')
    	                   ->orderBy('comments_count')
    	                   ->orderBy('favorite_to_users_count')
    	                   ->take(5)->get();
    	 $total_pending_posts = $post->where('is_aproved',false)->count();
    	$all_view=$post->sum('view_count'); 
    	                  
    	return view('author.dashbord',compact('post','popular_post','total_pending_posts','all_view'));
    }
}
