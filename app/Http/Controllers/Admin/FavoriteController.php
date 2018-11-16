<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class FavoriteController extends Controller
{
    public function index()
    {
    	$posts=Auth::user()->favorite_to_posts;
    	return view('admin.favorite',compact('posts'));
    }
}
