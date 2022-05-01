<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Post;
use App\Comment;
use App\User;

class ProfileController extends Controller
{

    public function index()
    {
        
        if($user=Auth::user()){
            $user=User::where('id',$user->id)->get();
        } else {
            $user=User::all();
        }

        return view('profile',compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if (isset($_COOKIE["changepasswd"])){
            if (!(Hash::check($request->get('password'), Auth::user()->password))) {
                // The passwords matches
                return redirect()->back()->with("error","Your current password does not matches with the password.");
            }
            if(strcmp($request->get('password'), $request->get('newpassword')) == 0){
                // Current password and new password same
                return redirect()->back()->with("error","New Password cannot be same as your current password.");
            }

            $validatedData = $request->validate([
                'username' => 'string|unique:users|max:90',
                'email' => 'string',
                'password' => 'required',
                'newpassword' => 'required|string|min:1|confirmed'
            ]);

        } else {
            $validateData=$request->validate([
                'username' => 'string|unique:users|max:90',
                'email' => 'string'
            ]);
        }

        $user->update($validateData);

        return redirect('/');
    }
}