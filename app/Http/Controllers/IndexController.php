<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    function index(){
        $title="Watchington Post";
        return view('index',['title'=>$title]);
        //return view('index');
    }
}
