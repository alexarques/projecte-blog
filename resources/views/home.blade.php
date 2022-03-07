@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Make your own post') }}</div>
                <div class="card-body">
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{-- Crear post --}}
                    <form method="GET" action="{{ route('posts.store') }}">
                        @csrf
                        <label>Title:</label><br>
                        <input type="text" id="title" name="title" style="width: 380px" required><br><br>
                        <textarea id="contents" name="contents" cols="40" rows="5"></textarea><br><br>
                        <input class="btn btn-primary" type="submit" value="Post">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    @php
        $num = 1;
    @endphp
    <div class="p-2">
        @foreach($posts as $post)
        {{-- <h6 style="float:right;">{{$num++}}</h6> --}}
            <h2>{{$post->title}}</h2>
            {{$post->contents}}
            <br><br>
            <div style="display:flex; flex-direction:row">
            {{-- Crear comentaris --}}
            <form method="GET" action="{{ route('posts.commstore') }}">
                <input type="text" id="comment" name="comment" style="width: 200px" required>
                <input class="btn btn-primary" type="submit" value="Comment">
            </form>
            @if ($post->user_id == 2/*$user->id || $user->role == 1*/)
            <br>
            <div style="display:flex; flex-direction:row; float: right;">
                {{-- Botó edit --}}
                <a class="btn btn-primary" style="margin:0px 2px 5px 500px" href="{{ route('posts.edit', $post->id) }}">Edit</a>
                {{-- Botó delete --}}
                <form method="DELETE" action="{{route('posts.destroy', $post->id)}}">
                    @csrf
                    @method('DELETE')
                    <input class="btn btn-danger" type="submit" style="margin:0px 2px 5px 2px" value="Delete">
                </form>
            </div>   
            @endif
            </div>
            {{-- @foreach( as $comment)
                <hr>
                @php
                    $num++;
                @endphp --}}
                {{-- @if ($comment->post_id == $num) --}}
                    {{-- <p>{{$comment}}</p> --}}

                {{-- @endif --}}
            {{-- @endforeach --}}
            <br>
            <hr>
        @endforeach
    </div>
</div>
@endsection
