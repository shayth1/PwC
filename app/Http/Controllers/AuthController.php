<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    // Login function Shayth PwC
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'

        ]);

        // Check email PwC Shayth
        $user = User::where('email', $fields['email'])->first();

        // Check Password PwC Shayth
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Oops email or password is not correct !'
            ], 401);
        }


        $token = $user->createToken('PwC-Shayth')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }




    // register function Shayth PwC
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'department_id' => 'required|integer|max:11',
            'password' => 'required|string|confirmed '

        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'user_level' => 'manager',
            'department_id' => $fields['department_id'],
            'password' => bcrypt($fields['password'])
        ]);
        $token = $user->createToken('PwC-Shayth')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }



    // Logout Function Shayth PwC

    public function logout()
    {
        Auth::user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return ['message' => 'you have been logged out successfully'];
    }
}