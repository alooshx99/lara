<?php

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', function (Request $request) {
    return response()->json(['laravel'])->setStatusCode(201);
});


Route::get('/posts', function (Request $request) {

    $startDate = Carbon::createFromDate(2015, 5, 17)->getTimestampMs();
    $endDate = Carbon::createFromDate(2021, 12, 12)->getTimestampMs();

    $data = DB::table('posts')->whereBetween('published_at',[$startDate,$endDate])->get();

    return response()->json($data)->setStatusCode(200);
});
