<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class NotificationsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //redirected to login
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke()
    {
        //get the authorizer user
        $user = auth()->user();
        $notifications = $user->notifications()->paginate(6, ['*'], 'notifications_page');
        return view('notifications.index', compact('user', 'notifications'));
    }
}