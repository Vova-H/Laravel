<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\VacancyController;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Public routs
//Route::apiResource('users', UserController::class);
Route::get('users/search/{name}', [UserController::class, 'search']);
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
//Protected routs
Route::group(['middleware' => ['auth:sanctum']], function () {
//vacancies
    //    Route::apiResource('vacancies', VacancyController::class);
    Route::get('/vacancies/{id}', [VacancyController::class, 'show']);
    Route::get('/vacancies', [VacancyController::class, 'index']);
    Route::post('/vacancy_add', [VacancyController::class, 'store']);
    Route::put('/vacancy/{vacancy}', [VacancyController::class, 'update']);
    Route::delete('/vacancy/{vacancy}', [VacancyController::class, 'delete']);

    //organizations
//        Route::apiResource('organizations', OrganizationController ::class);
    Route::get('/organizations/{id}', [OrganizationController::class, 'show']);
    Route::get('/organizations', [OrganizationController::class, 'index']);
    Route::post('/organization_add', [OrganizationController::class, 'store']);
    Route::put('/organization/{organization}', [OrganizationController::class, 'update']);
    Route::delete('/organization/{organization}', [OrganizationController::class, 'delete']);

//users
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});







