<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $login = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if(Auth::attempt($login))
        {
            $accessToken = Auth::user()->createToken('authToken')->accessToken;
            return response(['user' => Auth::user(), 'accessToken' => $accessToken]);
        }
        else
        {
            return response(['message' => "აღნიშნული მონაცემებით მომხმარებელი არ მოიძებნა ჩვენს ბაზაში"]);
        }
    }
}
