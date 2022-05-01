@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Benvingut, ') }}{{ Auth::user()->username }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('profile.update', Auth::user()->id) }}">
                        @csrf
                        @method('PUT')
                        <br><h5>Nom d'usuari:</h5>
                        <input type="text" id="username" name="username" style="width: 300px" value="{{Auth::user()->username}}"><br>
                        <br><h5>Correu electrónic:</h5>
                        <input type="text" id="email" name="email" style="width: 300px;margin-top:2px;" value="{{Auth::user()->email}}">
                        {{-- <button class="btn btn-primary" style="float:right" id="passwd">Reset</button> --}}
                        <br><br><label id="passwd" style="cursor:pointer;color:blue;text-decoration:underline;">Cambiar contraseña</label>
                        <div id="mostrar"></div>
                        <br><label id='closew' style='display:none;'>Tanca pestanya</label>
                        <input class="btn btn-primary" style="float:right" type="submit" value="Edit">
                    </form>

                </div>
            </div>
        </div>
    </div>
    
    <br>
</div>
<script type="text/javascript">
    document.getElementById("passwd").addEventListener("click", function(){
        document.cookie = "changepasswd=;";
        document.getElementById("mostrar").innerHTML = "</br><hr></br><h5>Confirma la contrasenya actual:</h5><input type='password' id='password' name='password' placeholder='Introdueix la contrasenya actual' style='width: 300px;margin-top:2px;'></br></br><h5>Nova contrasenya:</h5><input type='password' id='new-password' name='new-password' placeholder='Introdueix la nova contrasenya' style='width: 300px;margin-top:2px;'></br></br><h5>Confirmar nova contrasenya:</h5><input type='password' id='new-password-confirm' name='new-password-confirm' placeholder='Introdueix de nou la nova contrasenya' style='width: 300px;margin-top:2px;'></br>";
        document.getElementById("passwd").remove();
        document.getElementById("closew").style = "cursor:pointer;color:blue;text-decoration:underline;";
    });
    document.getElementById("closew").addEventListener("click", function(){
        document.cookie = "changepasswd=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        location.reload();
    });
    // window.onload{
    //     document.cookie = "changepasswd=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    // }
</script>
@endsection
