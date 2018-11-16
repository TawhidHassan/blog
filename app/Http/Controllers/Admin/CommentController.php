<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Comment;
use App\User;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function index()
    {
    	$comments=Comment::latest()->get();
    	return view('admin.comments',compact('comments'));
    }
    public function destroy($id)
    {
       $comment=Comment::findOrFail($id);
       $comment->delete();
       Toastr::success('comment Successfully Deleted :)','Success');
       return redirect()->back();

    }
}
