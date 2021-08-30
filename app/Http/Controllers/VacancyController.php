<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookVacancyRequest;
use App\Http\Requests\CreateVacancyRequest;
use App\Http\Requests\VacancyUpdateRequest;
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
        // вариант для юзера и работодателя
//        $vacancy = Vacancy::has('users', '<', DB::raw('vacancies.amount_workers'))->Limit(10)->get();
//        return response()->json($vacancy, 200);

        // вариант для работодателя
        $vacancy = Vacancy::all()->load('users')->where('created_by', '=', Auth::id());
        return response()->json($vacancy, 200);
    }

    public function show(Request $request, Vacancy $vacancy)
    {
        if ($request->user()->cannot('view', $vacancy)) {
            return response()->json('access denied !', 200);
        }
        return response()->json(VacancyResource::make($vacancy->load('users')), 200);
    }

    public function store(CreateVacancyRequest $request, Vacancy $vacancy)
    {
        if ($request->user()->cannot('create', $vacancy)) {
            return response()->json('access denied !', 200);
        }
        // ВАРИАНТ ЧЕРЕЗ CREATE()
        $vacancy = Vacancy::create($request->validated());
        $vacancy->created_by = Auth::user()->id;
        $vacancy->save();
        return response()->json($vacancy, 201);
    }

    public function update(VacancyUpdateRequest $request, Vacancy $vacancy)
    {
        if ($request->user()->cannot('update', $vacancy)) {
            return response()->json('access denied !', 200);
        }
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

    public function Book(BookVacancyRequest $request, Vacancy $vacancy)
    {
        if ($request->user()->cannot('book', $vacancy)) {
            return response()->json('access denied !', 200);
        }
        $vacancy = DB::table('user_vacancies')->where('user_id', '=', Auth::id())->where('vacancy_id', '=', $request->vacancy_id);

        if ($vacancy) {  //// не работает
            return 'You already book on this vacancy';
        }

        $book = UserVacancy::create($request->validated());
        return response()->json($book, 201);
    }

    public function UnBook($vacancy_id)
    {
        $vacancy = DB::table('user_vacancies')->where('user_id', '=', Auth::id())->where('vacancy_id', '=', $vacancy_id);
        if ($vacancy) {
            $vacancy->delete();
        }
        return response()->json(null, 200);
    }

    public function reject($vacancy_id, Vacancy $vacancy, Request $request, $user_id)
    {
        if ($request->user()->cannot('reject', $vacancy)) {
            return response()->json('access denied !', 200);
        }
        $vacancy = DB::table('user_vacancies')->where('user_id', '=', $user_id)->where('vacancy_id', '=', $vacancy_id);
        if ($vacancy) {
            $vacancy->delete();
        }
        return response()->json(null, 200);
    }
}
