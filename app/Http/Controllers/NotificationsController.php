<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;

class NotificationsController extends Controller
{
    public function index(){
        $notifications = Auth::user()->notifications()->paginate(20);
        Auth::user()->markAsRead();

        return view('main-pages.notifications', compact('notifications'));
    }

    public function clear(){
        $notificatoins = Auth::user()->notifications()->delete();

        return redirect()->back();
    }
}
