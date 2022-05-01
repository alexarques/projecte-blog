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
                    <form method="POST" action="{{ route('posts.update', $post->id) }}">
                        @csrf
                        @method('PUT')
                        <label>Title:</label><br>
                        <input type="text" id="title" name="title" style="width: 380px" value="{{$post->title}}"><br><br>
                        <input type="text" id="contents" name="contents" style="width: 650px;" value="{{$post->contents}}"><br><br>
                        <input class="btn btn-primary" type="submit" value="Post">
                    </form>
                    {{-- {{ __('You are logged in!') }} --}}
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="p-2">
    </div>
</div>
@endsection
