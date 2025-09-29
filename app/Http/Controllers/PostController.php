<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrUpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @throws \Throwable
     */
    public function index(): ResourceCollection
    {
        Gate::authorize('viewAny', Post::class);

        return Post::with('author')->paginate()->toResourceCollection();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateOrUpdatePostRequest $request): JsonResource
    {
        Gate::authorize('store', Post::class);

        $post = new Post();

        $post->fill($request->validated());
        $post->author_id = $request->user()->id;

        $post->save();

        return $post->toResource();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): JsonResource
    {
        Gate::authorize('view', $post);

        $post->increment('views');

        return $post->load('author')->toResource();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateOrUpdatePostRequest $request, Post $post): JsonResource
    {
        Gate::authorize('update', $post);

        $post->update(
            $request->validated()
        );

        return $post->toResource();
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
