<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(CreateUserRequest $request)
    {
        $user = User::create([
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'name' => $request['name'],
            'last_name' => $request['last_name'],
            'country' => $request['country'],
            'city' => $request['city'],
            'phone' => $request['phone'],
            'role' => $request['role'],
        ]);

        $token = $user->createToken('secret_token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }


    public function login(LoginRequest $request)
    {

        //check email
        $user = User::where('email', $request['email'])->first();

        //check password

        if (!$user || !Hash::check($request['password'], $user->password)) {
            return response([
                'message' => 'Bad data'
            ], 401);
        }

        $token = $user->createToken('secret_token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }


    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }


}
