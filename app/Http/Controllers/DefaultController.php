<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DefaultController extends Controller
{
    public function home(){
        return view("main-pages.home");
    }

    public function login(){
        return view("main-pages.login");
    }

    public function category(){
        return view("main-pages.category");
    }

    public function content(){
        return view("main-pages.content");
    }
}
