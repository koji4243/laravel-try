<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserContoroller;

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

Route::get('/users',[UserContoroller::class, 'index'])->name('users');

Route::get('/users/{user}',[UserContoroller::class, 'show'])->name('show');

Route::get('/users/create',[UserContoroller::class, 'create'])->name('create');

Route::post('/users/create',[UserContoroller::class, 'check'])->name('check');

