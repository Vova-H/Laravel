<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrganizationRequest;
use App\Http\Resources\OrganizationResource;
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

    public function show(Request $request,Organization $organization)
    {
        if ($request->user()->cannot('view', $organization)) {
            return response()->json('access denied !', 200);
        }

//        $vacancy = $organization->vacancies;
        return response()->json(OrganizationResource::make($organization), 200);
    }

    public function store(CreateOrganizationRequest $request)
    {
        // ВАРИАНТ ЧЕРЕЗ CREATE()
        $organization = Organization::create($request->validated());
//        $vacancy->created_by = Auth::user()->id;
//        $vacancy->save();
        return response()->json($organization, 201);
    }

    public function update(CreateOrganizationRequest $request, Organization $organization)
    {
//        $vacancy = Vacancy::find($id); поменять $id на $organization
        $organization->update($request->validated());
        return response()->json($organization, 200);
    }

    public function delete(Organization $organization)
    {
//        $organization = Organization::find($id);
        if ($organization) {
            $organization->delete();
        }
        return response()->json(null, 200);
    }
}
