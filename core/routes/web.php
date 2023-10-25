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
    Route::get('/login', 'login');
    Route::get('/singup', 'singup');
    Route::get('/dashboard', 'dashboard');
    Route::get('/project', 'project');
    Route::get('/docs', 'swagger');
});
