<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookVacancyRequest;
use App\Http\Requests\CreateVacancyRequest;
use App\Http\Resources\VacancyResource;
use App\Models\UserVacancy;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VacancyController extends Controller
{
    public function index(Request $request, Vacancy $vacancy)
    {
        if ($request->user()->cannot('viewAny', $vacancy)) {
            return response()->json('access denied !', 200);
        }
        $vacancy = Vacancy::has('users', '<', DB::raw('vacancies.amount_workers'))->Limit(10)->get();
        return response()->json($vacancy, 200);
    }

    public function show(Vacancy $vacancy)
    {
        return response()->json(VacancyResource::make($vacancy), 200);
    }

    public function store(CreateVacancyRequest $request, Vacancy $vacancy)
    {
//        dd($request);
        if ($request->user()->cannot('create', $vacancy)) {
            return response()->json('access denied !', 200);
        }
        // ВАРИАНТ ЧЕРЕЗ CREATE()
        $vacancy = Vacancy::create($request->validated());
        $vacancy->created_by = Auth::user()->id;
        $vacancy->save();
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

    public function Book(BookVacancyRequest $request)
    {
        $book = UserVacancy::create($request->validated());
        return response()->json($book, 201);
    }

    public function UnBook($id_vacancy)
    {
        $vacancy = DB::table('user_vacancies')->where('user_id', '=', Auth::id())->where('vacancy_id', '=', $id_vacancy);
        if ($vacancy) {
            $vacancy->delete();
        }
        return response()->json(null, 200);
    }
}
