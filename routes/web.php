<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;

// Route::get('/users', [UserController::class, 'index']);
// Route::get('/user/{id}', [UserController::class, 'show']);
// Route::get('/students', [StudentController::class, 'index']);

// Common routes naming
//  Index - shows all data ro students
//  Show - show a single data or student
//  Create - show a form
//  Store - store a data
//  Edit - show form to edit a data
//  Update - update a data
//  Destroy - delete a data


Route::get('/register', [UserController::class, 'register']);
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login/process', [UserController::class, 'process']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/store', [UserController::class, 'store']);
Route::get('/', [StudentController::class, 'index'])->middleware('auth');
Route::controller(StudentController::class)->group(function () {

    
    Route::get('/add/student','create');
    Route::post('/add/student','store');
    Route::get('/student/{student}','show');
    Route::put('/student/{student}','update');
    Route::delete('/student/{student}','destroy');
});
