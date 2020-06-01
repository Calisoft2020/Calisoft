<?php

namespace App\Container\Calisoft\Src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class NotificationController extends Controller
{
    function __construct(){
        $this->middleware('auth');
    }

    function index(){
        return auth()->user()->notifications;
    }

    function store(){
        auth()->user()->unreadNotifications->markAsRead();
    }

    
    public function vista()
    {
        return view('calisoft.global.notificaciones');
    }
}
