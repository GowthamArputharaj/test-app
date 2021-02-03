<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\CustomDatabaseNotification;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = [];
        $users = User::all();
        if(auth()->user()) {
            $notifications = auth()->user()->unreadNotifications;
        }
        if(count($notifications) > 0) {
            foreach($notifications as $notification) {
                // dd($notification);
                // $notification->markAsRead();
            }
        }

        return view('notification.index', compact('notifications', 'users'));
    }

    public function sendNotification(Request $request)
    {
        
        $sendNotifyTo = request()->user_id;
        User::find($sendNotifyTo)->notify(new CustomDatabaseNotification());

        return response(['message' => 'Message sent from Gowtham']);
    }

    public function readNotification(Request $request)
    {
        $notification = DB::table('notifications')->where('id', request()->notification_id ?? 0)->first();
        $notifications = auth()->user()->unreadNotifications;
        foreach($notifications as $not) {
            if($not->id == $request->notification_id) {
                $not->markAsRead();
            }
        }

        return response(['message' => 'Notification is marked as read']);
    }

}
