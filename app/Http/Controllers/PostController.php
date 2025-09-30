<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrUpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        Gate::authorize('viewAny', Post::class);

        return response()->json([
            'posts' => Post::paginate()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateOrUpdatePostRequest $request): JsonResponse
    {
        Gate::authorize('store', Post::class);

        $post = new Post();

        $post->fill($request->validated());
        $post->author_id = $request->user()->id;

        $post->save();

        return response()->json(['post' => $post], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): JsonResponse
    {
        Gate::authorize('view', $post);

        return response()->json(['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateOrUpdatePostRequest $request, Post $post): JsonResponse
    {
        Gate::authorize('update', $post);

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
        Gate::authorize('delete', $post);

        $post->delete();

        return response()->noContent();
    }
}
