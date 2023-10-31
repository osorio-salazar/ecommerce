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
        $user = Auth::user(); // Obtén al usuario autenticado

        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }
    }
}
