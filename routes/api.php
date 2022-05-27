<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VotingRequestController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/pollRequest/{boothId}', [VotingRequestController::class, 'get'])->name('api.poll');

Route::post('/pollRequest/update/{boothId}', [VotingRequestController::class, 'update']);

Route::get('/voting/candidates/{id}', [HomeController::class, 'candidates'])->name('api.candidates');
