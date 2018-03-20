<?php

namespace App\Http\Controllers;

use App\Admins;
use App\Http\Requests\LoginFormRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Config;


class AdminController extends Controller
{
    public function login(LoginFormRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        if (!$token = JWTAuth::attempt($credentials)) {
            return response([
                'status' => false,
                'data' => 'Invalid E-mail or Password',
                'code' => 'invalid.credentials'
            ], 400);
        }

        return response([
            'status' => true,
            'data' => 'Bearer ' . $token
        ])->header('Authorization', 'Bearer ' . $token);
    }

    public function user(Request $request)
    {
        try {
            $adminUser = Admins::find(Auth::user()->id);
            return response($adminUser);
        } catch (\ErrorException $error) {
            return response(['status' => false, 'data' => 'Unable to verify authentication'], 400);
        }


    }


}
