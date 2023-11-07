<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;




class UserController extends Controller
{



    // ...

    public function getInfoUser()
    {
        if (Auth::user()) {
            $user = Auth::user();
            $roleId = DB::table('users')
                ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
                ->join('roles', 'user_roles.role_id', '=', 'roles.id')
                ->where('users.id', '=', $user->id)
                ->select('roles.id')
                ->first()
                ->id;

            return response()->json([
                'user' => $user,
                'role_id' => $roleId
            ]);
        } else {
           return ('0');
        }
    }


    // ...




    public function getAuth()
    {

        $user = Auth::user();

        if ($user) {
            return $user;
        } else {
            return $user = 0;
        }
    }
}
