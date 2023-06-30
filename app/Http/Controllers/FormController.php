<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\EmailNotifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class FormController extends Controller
{
    public function send_email(Request $request) {
        
        $input = $request->all();
        $users = explode(',',$input['recipients']);
        $finalUsers = [];

        foreach ($users as $user) {
            $user = new User(['email' => $user]);
            array_push($finalUsers,$user);
        }
      
        // $user2 = new User(['email' => 'Info@steppingglory.com']);
        // $user3 = new User(['email' => 'info@ritan360.com']);

        // $users = [$user1, $user2,$user3];

        // dd($finalUsers);

        Notification::send($finalUsers,new EmailNotifier($input));       
        
        return response()->json([
            'message' => 'Email Submitted',
        ],201);
    }
}
