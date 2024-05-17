<?php

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', function (Request $request) {
 //   $username = $request->get('username');
   // $password = $request->get('password');
    return Response::json($request->all())->setStatusCode(201);


});


Route::get('/posts', function (Request $request) {

    $startDate = Carbon::createFromDate($request->get('start_Date'))->getTimestampMs();
    $endDate  = Carbon::createFromDate($request->get('end_Date'))->getTimestampMs();

    $data = DB::table('posts')->whereBetween('published_at', [$startDate,$endDate])->get();

    return response()->json($data)->setStatusCode(200);
});
