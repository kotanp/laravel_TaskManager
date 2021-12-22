<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

//Task routes
Route::get('/api/tasks', [TaskController::class, 'index']);
Route::get('/api/task/{id}', [TaskController::class, 'show']);
Route::put('/api/task/{id}', [TaskController::class, 'update']);
Route::post('/api/task', [TaskController::class, 'store']);
Route::delete('/api/task/{id}', [TaskController::class, 'destroy']);
Route::get('/api/task/sort/{column}/order/{orderby}', [TaskController::class, 'sortBy']);
Route::get('/api/tasks/expand={child}', [TaskController::class, 'expand']);
Route::get('/api/task/search/{column}/{expression}/{value}', [TaskController::class, 'search']);

//User routes
Route::get('/api/users', [UserController::class, 'index']);
Route::get('/api/user/{id}', [UserController::class, 'show']);
