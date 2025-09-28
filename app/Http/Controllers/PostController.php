<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrUpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'posts' => Post::paginate()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateOrUpdatePostRequest $request): JsonResponse
    {
        $post = Post::create(
            $request->validated()
        );

        return response()->json(['post' => $post], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): JsonResponse
    {
        return response()->json(['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateOrUpdatePostRequest $request, Post $post): JsonResponse
    {
        $post->update(
            $request->validated()
        );

        return response()->json(['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): Response
    {
        $post->delete();

        return response()->noContent();
    }
}
