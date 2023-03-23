<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class LoginController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'username' => 'required|string|email',
            'password' => 'required|string',
        ]);

        //code...
        $response = Http::asForm()->post('http://perfumes-zeus.test/oauth/token', [
            'grant_type' => 'password',
            'client_id' => ENV('PASSWORD_GRANT_CLIENT_CLIENT_ID'),
            'client_secret' => ENV('PASSWORD_GRANT_CLIENT_CLIENT_SECRET'),
            'username' => $request->username,
            'password' => $request->password,
            'scope' => '*',
        ]);
    
        return response()->json([
            "token_type" => $response['token_type'],
            "expires_in"=>$response['expires_in'],
            "access_token"=>$response['access_token'],
            "refresh_token"=>$response['refresh_token'],
        ]);
    }
}