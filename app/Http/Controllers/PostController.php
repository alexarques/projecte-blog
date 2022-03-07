<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;

use App\Post;
use App\Comment;
use App\User;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($user=Auth::user()){
            $posts=Post::where('user_id',$user->id)->get();
        } else {
            $posts=Post::all();
        }

        return view('posts.index',compact('posts'))/*->with('posts', $posts)*/;
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
        // if($user->can('create',Post::class)){
        //     Response::allow();
        // } else {
        //     Response::deny('No se puede');
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $post = new Post();
        $post->title = $request->get('title');
        $post->contents = $request->get('contents');
        $post->user_id = $user->id;

        $post->save();

        
        return back();


    }

    public function commstore(Request $request)
    {
        $user = Auth::user();
        $post = Post::all();
        $_SESSION["postall"] = $post;
        $_SESSION["commall"] = Comment::all();

        $comment = new Comment();
        $comment->comment = $request->get('comment');
        $comment->post_id = /*$post->id*/1;
        $comment->user_id = $user->id;

        $comment->save();

        return back();

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
        // $validateData=$request->validate([
        //     'title' => 'string|unique:posts|max:90',
        //     'contents' => 'string'

        // ]);
        // $post->update($validateData);
        // return back();
        return view('edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::where('id',$id);
        $post->title = $request->get('title');
        $post->contents = $request->get('contents');
        $post->user_id = $post->user_id;

        $post->save();
        /*Post::where('id',3)->update(['title'=>'Updated title']);*/
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Post::find($id);
        $data->delete();

        // return redirect('posts');
        return back();
    }
}
