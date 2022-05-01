<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;

use App\Post;
use App\Comment;
use App\User;
use App\Tag;

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

        return view('home',compact('posts'))/*->with('posts', $posts)*/;
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
        $tags = explode(',', $request->get('tags'));

        $post->save();

        if(count($tags) > 1){
            foreach($tags as $tag) {
                $t=Tag::create(['tag'=>$tag]);
                $post->tags()->attach($t);
            }
        } else {
            $tags = $request->get('tags');
            $t=Tag::create(['tag'=>$tags]);
            $post->tags()->attach($t);
        }

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

    public function edit(Post $post)
    {
        // return back();
        // $post = Post::where('id',$post->id);
        // setcookie('post', $post->id);
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // $post = Post::find($_COOKIE['post']);
        // $post->title = $request->get('title');
        // $post->contents = $request->get('contents');
        // $post->user_id = $post->user_id;

        // $post->save();

        $validateData=$request->validate([
            'title' => 'string|unique:posts|max:90',
            'contents' => 'string'
        ]);

        $post->update($validateData);
        return redirect('/');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->comments()->get()->delete();
        $post->delete();

        return back();
    }

    public function searching(Request $request)
    {
        $results = Post::where("title",'like',$request->texto."%")->take(10)->get();
        return view("home",compact("results"));        
    }

}
