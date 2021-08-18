<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\CreateVacancyRequest;

class VacancyController extends Controller
{

    public function index()
    {
        return Vacancy::all();
    }

    public function show($id)
    {
        return Vacancy::find($id);
    }

    public function store(CreateVacancyRequest $request)
    {
        // ВАРИАНТ ЧЕРЕЗ CREATE()
        $vacancy = Vacancy::create($request->validated());
//        $vacancy->created_by = Auth::user()->id;
//        $vacancy->save();
        return response()->json($vacancy, 201);
    }

    public function update(CreateVacancyRequest $request, Vacancy $vacancy)
    {
//        $vacancy = Vacancy::find($id);
        $vacancy->update($request->validated());
        return response()->json($vacancy, 200);
    }

    public function delete($id)
    {
        $vacancy = Vacancy::find($id);
        if ($vacancy) {
            $vacancy->delete();
        }
        return response()->json(null, 200);
    }
}
