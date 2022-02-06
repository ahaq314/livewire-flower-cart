<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
     function index() {
        
         $notifications = auth('admin')->user()->unreadNotifications;
          return view('admin.home',compact('notifications'));
    }

    public function markNotification(Request $request){

    auth('admin')->user()
        ->unreadNotifications
        ->when($request->input('id'), function ($query) use ($request) {
            return $query->where('id', $request->input('id'));
        })
        ->markAsRead();

    return response()->noContent();
}
}
