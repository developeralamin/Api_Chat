<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MessageController;



Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::get('auth-user', [AuthController::class, 'authUser'])->middleware('auth:sanctum');

Route::group(['prefix' => 'message', 'middleware' => 'auth:sanctum'], function() {

    Route::get("/online-users", action: [UsersController::class, "getOnlineUsers"]);
    
    Route::post("/send", [MessageController::class, "store"]);
    Route::put("/{id}/delivered", [MessageController::class, "markAsDelivered"]);
    Route::put("/{id}/read", [MessageController::class, "markAsRead"]);

});