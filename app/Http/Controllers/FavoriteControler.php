<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class FavoriteControler extends Controller
{
    public function add($post)
    {
    	$user=Auth::user();
       $isfavorite=$user->favorite_to_posts()->where('post_id',$post)->count();
       if($isfavorite==0)
       {
       	$user->favorite_to_posts()->attach($post);
       		Toastr::success('post successfully added to favorite list','success');
         	return redirect()->back();
       }
       else
       {
       	$user->favorite_to_posts()->detach($post);
       		Toastr::success('post successfully remove to favorite list','detach');
         	return redirect()->back();
       }
    }
}
