<?php

namespace App\Http\Controllers\Admin;

use App\Subscriber;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriberController extends Controller
{

    /**
     *
     */
    public function index()
    {
       $subscriber=Subscriber::latest()->get();
       return view('admin.subscriber.index',compact('subscriber'));
    }
    public function destroy($subscriber)
    {
        Subscriber::findOrfail($subscriber)->delete();
        Toastr::success('post Successfully Deleted :)','Success');
        return redirect()->back();
    }
}
