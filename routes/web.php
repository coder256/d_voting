<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\EnsureVotingIsValid;
use App\Http\Controllers\VoteController;

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

Auth::routes();

//Route::get('/', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm']);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.home');

Route::resource('user', 'App\Http\Controllers\UserController')->middleware('auth');
Route::resource('booth', 'App\Http\Controllers\BoothController')->middleware('auth');
Route::resource('vote', 'App\Http\Controllers\VoteController')->middleware('auth');
Route::resource('post', 'App\Http\Controllers\PostController')->middleware('auth');
Route::resource('candidate', 'App\Http\Controllers\CandidateController')->middleware('auth');
Route::get('/candidate/candidates/{id}', [App\Http\Controllers\CandidateController::class, 'candidates'])->name('candidates')->middleware('auth');

Route::get('/voting/scan',[HomeController::class, 'scan'])->name('home.scan');
Route::get('/voting/vote', [HomeController::class, 'vote'])->name('home.vote')->middleware(EnsureVotingIsValid::class);
Route::post('/voting/cast', [HomeController::class, 'cast'])->name('home.cast');

Route::get('/test', [VoteController::class, 'test']);
