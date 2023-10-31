<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Log;




class UserController extends Controller
{
    public function getInfoUser()
    {
        $users = \Illuminate\Support\Facades\DB::table("sessions")->select("user_id")->get();
        $users  = json_decode(json_encode($users), true);
        Log::info($users);


        foreach ($users as $user) {

            $usuario = \App\Models\User::find($user);

            return response()->json($usuario);
            //return $user;
        }
    }
}
