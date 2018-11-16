<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\User;
use App\Post;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
    public function index()
    {
    	$authors=User::authors()
    	->withCount('posts')
    	->withCount('comments')
    	->withCount('favorite_to_posts')
    	->get(); /*aikhana scope use kora hoysa jata user model a difine kora*/
        return view ('admin.author',compact('authors'));
    }
    public function destroy($id)
    {
    	$author=User::findOrFail($id)->delete();
    	Toastr::success('Author delete Successfully:)' ,'Success');
        return redirect()->back();
    }
}
