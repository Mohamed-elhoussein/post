<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::controller(UserController::class)->group(function(){
Route::post("register","register");
Route::post('login', 'login');
});
Route::apiResource("post",postsController::class)->middleware("auth:sanctum");
