<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $startDate = Carbon::createFromDate($request->get('start_Date'))->getTimestampMs();
        $endDate  = Carbon::createFromDate($request->get('end_Date'))->getTimestampMs();

        $posts = Post::whereBetween('published_at', [$startDate, $endDate])->orderBy('likes')->get();
        return Response::json($posts)->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'title' => ['required', 'string','unique:posts', 'min:3' , 'max:255'],
            'description' => ['required', 'string', 'min:10' , 'max:255'],
            'image_url' => ['nullable', 'string', ''],
            'published_at' => ['nullable','sometimes' ,'date'],

        ]);
    $post = Post::create($attributes);

    return Response::json($post)->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return Response::json($post)->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $post->update([
            'title' =>$request->get('title'),
            'description'=> $request->get('description'),
            'image_url'=> $request->get('image_url'),
            'published_at'=> $request->get('published_at'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return Response::json($post)->setStatusCode(204);
    }
}
