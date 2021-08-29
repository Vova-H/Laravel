<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\Null_;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $user = User::create($request->validated());
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
        if (!$user || !Hash::check($request['password'], $user->password)) {  // СДЕЛАТЬ ХЭШИРОВАНИЕ ДЛЯ ПАРОЛЯ
//        if (!$user || !$user = User::where('password', $request['password'])->first()) { // ВРЕМЕННАЯ ЗАГЛУШКА
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
        Auth::user()->currentAccessToken()->delete();
        return response()->json('Logged out successfully ', 200);
    }

}
