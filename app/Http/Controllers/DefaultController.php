<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function home(){
        return view("main-pages.home");
    }

    public function login(){
        return view("main-pages.login");
    }
}
