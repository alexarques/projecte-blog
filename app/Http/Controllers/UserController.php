<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\User;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;

// class UserController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function index()
//     {
//         //
//     }

//     /**
//      * Show the form for creating a new resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function create()
//     {
//         //
//         return view('profile.create');
//     }

//     /**
//      * Store a newly created resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\Response
//      */
//     public function store(Request $request)
//     {
//         //
//         //$user = Auth::user();

//         $user = new User();

//         $user->username = $request->get('username');
//         $user->email = $request->get('email');
//         $user->password = Hash::make($request->get('password'));
//         $user->role_id = $request->get('role_id');

//         //dd($user);

//         $user->save();

//         return redirect('user/showAll');
//     }

//     /**
//      * Display the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function show($id)
//     {
//         //
//     }

//     /**
//      * Display the specified resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function showAll()
//     {
//         //
//         $users = User::all();

//         return view('profile.selectUser', ['users' => $users]);
//     }

//     /**
//      * Show the form for editing the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function edit($id)
//     {
        
//         $user = User::find($id);

//         return view('profile.edit', ['user' => $user]);
//     }

//     /**
//      * Update the specified resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function update(Request $request, $id)
//     {
//         //
//         $user = User::find($id);

//         $user->username = $request->get('username');
//         $user->email = $request->get('email');
//         $user->updated_at = now();

//         $user->save();

//         return back();
//     }

//     /**
//      * Remove the specified resource from storage.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function destroy($id)
//     {
//         //
//         $user = User::find($id);

//         $user->delete();

//         return back();
//     }
// }
