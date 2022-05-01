<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function buscador(Request $request){
        $nombres    =   Nombres::where("nombre",'like',$request->texto."%")->take(10)->get();
        return view("nombres.paginas",compact("nombres"));        
    }
}
