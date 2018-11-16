<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
     public function index()
    {
       return view('author.settings');
    }

     public function updateProfile(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'required|image',
        ]);
        $slug = str_slug($request->name);
        $user = User::findOrFail(Auth::id());

        if($request->hasFile('image'))
       {
          Storage::delete($user->image);
          $image=Storage::putFile('public/profile/',$request->image);
       }
       else {
            $imageName = $user->image;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $image;
        $user->about = $request->about;
        $user->save();
        Toastr::success('Profile Successfully Updated :)','Success');
        return redirect()->back();
    }

     public function updatePassworde(Request $request)
    {
       $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

       $haspassword=Auth::user()->password;
       if(Hash::check($request->old_password,$haspassword))
       {
         if(!Hash::check($request->password,$haspassword))
         {
         	$user= User::find(Auth::id());
         	$user->password=Hash::make($request->password);
         	$user->save();
         	Toastr::success('Password change Successfully:)','Success');
         	Auth::logout();
         	return redirect()->back();
         }
         else{
         	Toastr::error('new Password can not be same as old password:)','error');
         	return redirect()->back();
         }
       }
       else
       {
       	Toastr::error(' Password can not be mach old password','error');
         	return redirect()->back();
       }
    }
}
