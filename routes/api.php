<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;



Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
