<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUgyvezeto;

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
})->middleware(['auth'])->name('kezdolap');

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
// Route::get('/user', function () {
//     return view('user');
// });
Route::get('/api/users', [UserController::class, 'index']);
Route::get('/api/user/{id}', [UserController::class, 'show']);
Route::delete('/api/user/{id}', [UserController::class, 'destroy']);

//Login
// Route::get('/login.php', function () {
//     return view('login');
// });

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/signin', [AuthController::class, 'authenticate'])->name('signin.custom');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/test', function () {
        return 'Hello';
    });
});

Route::middleware(['auth', IsUgyvezeto::class])->group(function () {
    Route::get('/user', function () {
        return view('user');
    });
});

Route::get('/api/logins', [AuthController::class, 'all']);

##
Route::get('/changepwd',function(){
    return view('changepwd');
});

Route::post('/change', [AuthController::class, 'changePassword'])->name('password.change');