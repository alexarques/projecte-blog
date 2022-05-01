<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Post;
use App\Comment;
use App\User;

class CommentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($user=Auth::user()){
            $comments=Comment::where('user_id',$user->id)->get();
        } else {
            $comments=Comment::all();
        }
        //return view('home',compact('comments'));
        return view('home', ['comments'=> $comments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        $this->authorize('create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $user = Auth::user();

        $comment = new Comment();
        $comment->comment = $request->get('comment');
        $comment->post_id = $post->id;
        $comment->user_id = $user->id;

        $comment->save();

        return back();

        // return back();
        // return view('home', compact('comments'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $validateData=$request->validate([
            'comment' => 'string'

        ]);
        $comment->update($validateData);
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $validateData=$request->validate([
    //         'title' => 'string|unique:posts|max:90',
    //         'contents' => 'string'

    //     ]);
    //     $comment->update($validateData);
    //     return back();

    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Comment::find($id);
        $data->delete();

        return back();
    }
}
