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
        Route::get('/dashboard/board-{project_id}', 'board');

        Route::get('/project/{project_id}', 'project');
        Route::get('/project/create', 'create_project');
    });
});

Route::group(['controller' => \App\Http\Controllers\AuthController::class, 'prefix' => 'auth'], function () {
    Route::post('login', 'login');
    Route::post('signup', 'signup');
    Route::get('logout', 'logout');
});

Route::group(['controller' => \App\Http\Controllers\ProjectController::class, 'prefix' => 'project', 'middleware' => 'check.auth'], function () {
    Route::post('save', 'save');
    Route::get('member/invite/{project_id}', 'delete_member');
    Route::get('member/delete/{member_id}', 'delete_member');
    Route::get('member/change_role/{member_id}/{new_role_slug}', 'change_member_role');
});

Route::group(['controller' => \App\Http\Controllers\TaskController::class, 'prefix' => 'task', 'middleware' => 'check.auth'], function () {
    Route::get('mark_as_completed/{task_id}', 'mark_task');
});
