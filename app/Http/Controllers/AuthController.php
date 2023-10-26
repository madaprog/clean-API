<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'firstname' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|confirmed'
        ]);
    
    

        $user = User::create([
            'firstname' => $fields['firstname'],
            'surname' => $fields['surname'],
            'email' => $fields['email'],
            'username' => $fields['username'],
            'password' => bcrypt($fields['password']),
        ]);

        $token = $user->createtoken('myapptoken')->plainTextToken;
        $otp = rand(100000,999999);

        $response = [
            'user' => $user,
            'token' => $token,
            'otp' => $otp
        ];


        return response($response, 200);


    }


    public function user_login(Request $request){
        $fields = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        //find user(username)
        $user = User::where('username', $fields['username'])->first();


        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Error Credentials'
            ], 401);
        }

        $token = $user->createtoken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 200);
    }


    public function reganarate_otp(){

    }



}
