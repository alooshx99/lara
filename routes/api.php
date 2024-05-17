<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', function (Request $request) {
    return response()->json(['laravel'])->setStatusCode(201);
});


Route::get('/posts', function (Request $request) {
    $data = DB::table('posts')->get();//test

    return response()->json($data)->setStatusCode(200);
});
