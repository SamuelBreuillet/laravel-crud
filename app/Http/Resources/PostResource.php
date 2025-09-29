<?php

namespace App\Http\Resources;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Post */
class PostResource extends JsonResource
{
    public static $wrap = 'post';

    public function toArray(Request $request): array
    {
        $canSeeSensitiveData = $this->canSeeSensitiveData($request);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,

            $this->mergeWhen($canSeeSensitiveData, [
                'views' => $this->views
            ]),

            'author_id' => $this->author_id,
            'author' => new UserResource($this->whenLoaded('author')),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    private function canSeeSensitiveData(Request $request): bool
    {
        $user = $request->user('sanctum');
        return $user && ($user->is_admin || $user->id === $this->author_id);
    }
}
