<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function index(Request $request, User $user)
    {
        if ($request->user()->cannot('viewAny', $user)) {
            return response()->json('access denied !', 200);
        }
        $user = User::limit(10)->get();
//        $user = User::all();
        return response()->json($user, 200);
    }

    public function create(CreateUserRequest $request)
    {
        $user = User::create($request->validated());
        return response()->json($user, 201);
    }

    public function show(Request $request, User $user)
    {
        if ($request->user()->cannot('view', $user)) {
            return response()->json('access denied !', 200);
        }
//        $user->vacancies();
//        $organization = $user->organizations;
//        return response()->json($user->load('organizations'), 200); // подгружаем через ресурсы
        return response()->json(UserResource::make($user), 200);
    }

    public function update(UpdateUserRequest $request, User $user)  /// проблема с юзером, приходит не то, что нужно
    {
//        $user = Auth::user();
//        dd($user);
        if ($request->user()->cannot('update', $user)) {
            return response()->json('access denied !', 200);
        }
        $user->update($request->validated());

        return response()->json($user, 200);
    }

    public function destroy(User $user, Request $request)
    {
        if ($request->user()->cannot('delete', $user)) {
            return response()->json('access denied !', 200);
        }
        if ($user) {
            Auth::user()->currentAccessToken()->delete();
            $user->delete();
        }
        return response()->json(null, 200);
    }

    public function search($name)
    {
        return User::where('name', 'like', '%' . $name . '%')->get();
    }

}
