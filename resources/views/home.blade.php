@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{--  --}}
            <div class="container">
                <!-- html agregado-->
                    <div class="col-8">
                        <div class="input-group">
                            <input type="text" class="form-control" id="texto" placeholder="Ingrese nombre">
                            <div class="input-group-append"><span class="input-group-text">Buscar</span></div>
                        </div>
                        <div id="resultados" class="bg-light border"></div>
                    </div>
                <!-- fin del html agregado-->
                    <div class="col-8" id="contenedor">
                        {{-- @include('posts.search') --}}
                    </div>
                    <div id="cargando" hidden><h1>CARGANDO...</h1></div>
                </div>
                {{-- @if (count($posts))
                    @foreach ($posts as $result)          
                        <p class="p-2 border-bottom">{{$result->id .' - '. $result->title}}</p>
                    @endforeach             
                @endif --}}
            {{--  --}}
            <br>
            <div class="card">
                <div class="card-header">{{ __('Make your own post') }}</div>
                <div class="card-body">
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{-- Crear post --}}
                    <form method="POST" action="{{ route('posts.store') }}">
                        @csrf
                        <label>Title:</label><br>
                        <input type="text" id="title" name="title" style="width: 380px" required><br><br>
                        <textarea id="contents" name="contents" cols="40" rows="5"></textarea><br><br>
                        <label>Tags:</label><br>
                        <input type="text" id="tags" name="tags" style="width: 380px"><br><br>
                        <input class="btn btn-primary" type="submit" value="Post">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="p-2">
            @foreach($posts->sortBy('id',SORT_REGULAR, true) as $post)
            @php
            $users_post = $post->user()->get();
            date_default_timezone_set('Europe/Madrid');
            $today = date('Y-m-d h:i:s');
            $date1 = new DateTime($today);
            $date2 = new DateTime($post->created_at);
            $diff_date = $date1->diff($date2);
            @endphp
            @foreach($users_post as $user_post)
                @if($diff_date->format('%d days ago') == '0 days ago' && $diff_date->format(intval('%h').' hours ago') == '0 hours ago' && $diff_date->format('%i minutes ago') == '0 minutes ago')
                    <p style="display: flex; float:right;">Created by {{$user_post->username}} | {{$diff_date->format('%s seconds ago')}}</p>
                @elseif($diff_date->format('%d days ago') == '0 days ago' && $diff_date->format(intval('%h').' hours ago') == '0 hours ago')
                    <p style="display: flex; float:right;">Created by {{$user_post->username}} | {{$diff_date->format('%i minutes ago')}}</p>
                @elseif($diff_date->format('%d days ago') == '0 days ago' )
                    <p style="display: flex; float:right;">Created by {{$user_post->username}} | {{$diff_date->format(intval('%h').' hours ago')}}</p>
                @else
                    <p style="display: flex; float:right;">Created by {{$user_post->username}} | {{$diff_date->format('%d days ago')}}</p>
                @endif
            @endforeach
            <h2>{{$post->title}}</h2>
            {{$post->contents}}<br><br>
            @foreach($post->tags()->get() as $tag)
            {{-- <form method="POST" action="{{route('tags.destroy', $tag)}}">
                @csrf
                @method('DELETE') --}}
                <input class="btn btn-secondary" type="button" style="margin:0px 2px 5px 2px" value="{{$tag->tag}}">
            {{-- </form> --}}
            @endforeach
            {{-- {{User::find($post->user_id)}} --}}
            <br><br>
            <div id="post" style="display:flex; flex-direction:row">
            {{-- Crear comentaris --}}
            <form method="POST" action="{{ route('comments.store', $post) }}">
                @csrf
                <input type="text" id="comment" name="comment" style="width: 200px" required>
                <input class="btn btn-primary" type="submit" value="Comment">
            </form>
            @if ($post->user_id == Auth::user()->id || Auth::user()->role_id == 1)
            <br>
            <div id="btcontrol" style="display:flex; flex-direction:row; float: right;">
                {{-- Botó edit --}}
                <a class="btn btn-primary" style="margin:0px 2px 5px 500px;" href="{{ route('posts.edit', $post->id) }}">Edit</a>
                {{-- Botó delete --}}
                <form method="POST" action="{{route('posts.destroy', $post)}}">
                    @csrf
                    @method('DELETE')
                    <input class="btn btn-danger" type="submit" style="margin:0px 2px 5px 2px" value="Delete">
                </form>
            </div>   
            @endif
            </div>
            @php
            $comments = $post->comments()->get();
            @endphp
            <br>
            @foreach($comments->sortBy('id',SORT_REGULAR, true) as $comment)
                @php
                $users = $comment->user()->get();
                @endphp
                @foreach($users as $user)
                    <p style="margin-left: 30px"><b>{{$user->username}}:</b> {{$comment->comment}}</p> 
                @endforeach
            @endforeach
            <hr>
        @endforeach
    </div>
    <script>
        window.addEventListener('load', function(){
            document.getElementById('texto').addEventListener('keyup'), () => {
                if((document.getElementById('texto').value.length)>=1){
                    fetch(`/posts/searching?texto=${document.getElementById('texto').value}`, {method:'get'})
                    .then(response => response.text())
                    .then(html => {document.getElementById('resultados').innnerHTML = html})
                } else {
                    document.getElementById('resultados').innnerHTML = '';
                }
            }
        });
    </script>
</div>
@endsection