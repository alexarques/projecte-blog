<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

use App\Post;
use App\User;

class ControlPanelController extends Controller
{
    public function index()
    {
        if($user=Auth::user()){
            $users=User::all();
        }
        return view('control_panel',compact('users'));
    }

    public function update(Request $request, User $user)
    {
        $validateData=$request->validate([
            'username' => 'string|unique:users|max:90',
            'email' => 'string'
        ]);

        $user->update($validateData);
        return back();

    }

    // public function update(Request $request, User $user)
    // {
    //     $user = User::find($user);
    //     $user->username = $request->get('username');
    //     $user->email = $request->get('email');

    //     $user->save();
    //     return back();

    // }

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }

}
