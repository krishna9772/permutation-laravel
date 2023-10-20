<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SolverController;
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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/',[SolverController::class,'solvePuzzle'])->name('home');

Route::get('go/{action}',[SolverController::class,'solvePuzzle'])->name('action');

