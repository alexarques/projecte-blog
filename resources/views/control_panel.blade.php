@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User list') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach($users as $user)
                        <div style="display: flex;flex-direction:row;">
                            <div>
                            <form method="POST" action="{{ route('control_panel.update', $user) }}">
                                @csrf
                                @method('PUT')
                                <input type="text" id="username" name="username" style="width: 300px" value="{{$user->username}}">
                                <input type="text" id="email" name="email" style="width: 300px" value="{{$user->email}}">
                            </div>
                                <input class="btn btn-primary" style="margin-left:50px;height:37px" type="submit" value="Edit">
                            </form>
                            <form method="POST" action="{{ route('control_panel.destroy', $user) }}">
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" style="margin-left:10px;" type="submit" value="Delete">
                            </form>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="p-2">
    </div>
</div>
@endsection