<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VacancyController extends Controller
{
    public function store(Request $request)
    {
        // ВАРИАНТ ЧЕРЕЗ CREATE()

        $vacancy = Vacancy::create($request->validated());
        $vacancy->created_by = Auth::user()->id;
        $vacancy->save();
        return response()->json($vacancy, 201);
    }
}
