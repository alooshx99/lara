<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', function (Request $request) {
    return Response::json($request->all())->setStatusCode(201);
});



Route::get('/posts',[PostController::class, 'index']);
Route::get('/posts/{post}',[PostController::class, 'show']);
Route::post('/posts',[PostController::class, 'store']);
Route::patch('/posts/{post}',[PostController::class, 'update']);
Route::delete('/posts/{post}',[PostController::class, 'destroy']);


Route::apiResource('/categories',CategoryController::class);




