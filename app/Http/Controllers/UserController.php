<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function register(CreateUserRequest $request)
    {
        $user = User::create($request->validated());
//        $user->created_by = Auth::user()->name;
//        $user->save();
        return response()->json($user, 201);
    }

    public function show($id)
    {
        return User::find($id);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function destroy($id)
    {
        return User::destroy($id);
    }

    public function search($name)
    {
        return User::where('name', 'like', '%' . $name . '%')->get();
    }


}
