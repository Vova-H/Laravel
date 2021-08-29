<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\VacancyController;
use App\Models\Vacancy;
use App\Models\User;
use App\Models\Organization;
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
//Route::get('users/search/{name}', [UserController::class, 'search']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

//users
Route::post('/create', [UserController::class, 'create'])->middleware('auth:sanctum');

Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware('auth:sanctum');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/users', [UserController::class, 'index'])->middleware('auth:sanctum');
Route::get('/users/{user}', [UserController::class, 'show'])->middleware('auth:sanctum');
Route::put('/users/{user}', [UserController::class, 'update'])->middleware('auth:sanctum');

//Protected routs
Route::group(['middleware' => ['auth:sanctum']], function () {

    //vacancies
    Route::apiResource('vacancies', VacancyController::class);

    //organizations
    Route::apiResource('organizations', OrganizationController ::class);

    //booking
    Route::post('/book', [VacancyController::class, 'Book']);
    Route::delete('/unBook/{id_vacancy}', [VacancyController::class, 'UnBook']);
});


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});







