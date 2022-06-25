<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AuthenticationController extends Controller
{
    //use this method to signin users
    public function signin(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string|email|',
            'password' => 'required|string|min:6'
        ]);

        if (!Auth::attempt($attr)) {
           
             return response()->json(['error' => 'Credentials not match'], 401);
        }

       
         return response()->json(['token' => auth()->user()->createToken('API Token')->plainTextToken], 200);
    }

}

