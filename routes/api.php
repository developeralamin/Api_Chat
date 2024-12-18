<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;



Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:sanctum')->prefix('user')->group(function () {
    Route::post('message',[MessageController::class,'store']);
});
