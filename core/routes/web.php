<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['controller' => FrontendController::class], function () {
    Route::get('/', 'index');

    Route::get('/login', 'login')->name('login');
    Route::get('/signup', 'signup')->name('signup');

    Route::group(['middleware' => 'check.auth'], function () {
        Route::get('/dashboard', 'dashboard');
        Route::get('/project', 'project');

        Route::get('/project/create', 'create_project');
        Route::get('/project/project-{project_id}', 'board');
    });
});

Route::group(['controller' => \App\Http\Controllers\AuthController::class, 'prefix' => 'auth'], function () {
    Route::post('login', 'login');
    Route::post('signup', 'signup');
});

Route::group(['controller' => \App\Http\Controllers\ProjectController::class, 'prefix' => 'project'], function () {
    Route::post('save', 'save');
});

Route::group(['controller' => \App\Http\Controllers\ProjectController::class, 'prefix' => 'project'], function () {

});
