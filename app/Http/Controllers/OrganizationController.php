<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrganizationRequest;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\CreateVacancyRequest;

class OrganizationController extends Controller
{

    public function index()
    {
        return Organization::all();
    }

    public function show($id)
    {
        return Organization::find($id);
    }

    public function store(CreateOrganizationRequest  $request)
    {
        // ВАРИАНТ ЧЕРЕЗ CREATE()
        $organization = Organization::create($request->validated());
//        $vacancy->created_by = Auth::user()->id;
//        $vacancy->save();
        return response()->json($organization, 201);
    }

    public function update(CreateOrganizationRequest $request, Organization $organization)
    {
//        $vacancy = Vacancy::find($id);
        $organization->update($request->validated());
        return response()->json($organization, 200);
    }

    public function delete($id)
    {
        $organization = Organization::find($id);
        if ($organization) {
            $organization->delete();
        }
        return response()->json(null, 200);
    }
}
