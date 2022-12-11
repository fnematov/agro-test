<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('auth/login', [\App\Http\Controllers\AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'vacancy', 'middleware' => 'role:' . \App\Enums\RolesEnum::ORGANIZATION->value], function () {
        Route::get('', [\App\Http\Controllers\VacancyController::class, 'index']);
        Route::post('', [\App\Http\Controllers\VacancyController::class, 'create']);
        Route::get('/{vacancy}', [\App\Http\Controllers\VacancyController::class, 'show']);
        Route::delete('/{vacancy}', [\App\Http\Controllers\VacancyController::class, 'delete']);
        Route::put('/{vacancy}', [\App\Http\Controllers\VacancyController::class, 'update']);
        Route::get('/{vacancy}/resumes', [\App\Http\Controllers\VacancyController::class, 'resumes']);
    });

    Route::group(['prefix' => 'resume', 'middleware' => 'role:' . \App\Enums\RolesEnum::EMPLOYEE->value], function () {
        Route::get('', [\App\Http\Controllers\ResumeController::class, 'index']);
        Route::post('', [\App\Http\Controllers\ResumeController::class, 'create']);
        Route::get('/{resume}', [\App\Http\Controllers\ResumeController::class, 'show']);
        Route::delete('/{resume}', [\App\Http\Controllers\ResumeController::class, 'delete']);
        Route::put('/{resume}', [\App\Http\Controllers\ResumeController::class, 'update']);
        Route::get('/{resume}/responded-vacancies', [\App\Http\Controllers\ResumeController::class, 'respondedVacancies']);
        Route::get('/{resume}/vacancies', [\App\Http\Controllers\ResumeController::class, 'resumeVacancies']);
        Route::post('/{resume}/{vacancy}/response', [\App\Http\Controllers\ResumeController::class, 'response']);
    });
});
