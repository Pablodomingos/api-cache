<?php

use App\Http\Controllers\Api\{
    CourseController,
    LessonController,
    ModuleController
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'controller' => CourseController::class,
], function () {
    Route::get('/courses', 'index');
    Route::post('/course', 'store');
    Route::put('/course/{uuid}', 'update');
    Route::get('/course/{uuid}', 'show');
    Route::delete('/course/{uuid}', 'destroy');
});

Route::group([
    'prefix' => '/course/{course}',
    'controller'=> ModuleController::class
], function () {
    Route::get('/modules', 'index');
    Route::post('/module', 'store');
    Route::put('/module/{uuid}', 'update');
    Route::get('/module/{uuid}', 'show');
    Route::delete('/module/{uuid}', 'destroy');
});

Route::group([
    'prefix' => '/module/{module}',
    'controller'=> LessonController::class
], function () {
    Route::get('/lessons', 'index');
    Route::post('/lesson', 'store');
    Route::put('/lesson/{uuid}', 'update');
    Route::get('/lesson/{uuid}', 'show');
    Route::delete('/lesson/{uuid}', 'destroy');
});
