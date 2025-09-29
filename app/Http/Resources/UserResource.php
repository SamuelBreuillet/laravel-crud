<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
class UserResource extends JsonResource
{
    public static $wrap = 'user';

    public function toArray(Request $request): array
    {
        $canSeeSensitiveData = $this->canSeeSensitiveData($request);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,

            $this->mergeWhen($canSeeSensitiveData, [
                'email_verified_at' => $this->email_verified_at,
                'is_active' => $this->is_active,
                'is_admin' => $this->is_admin,
                'remember_token' => $this->remember_token,
            ]),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    private function canSeeSensitiveData(Request $request): bool
    {
        $user = $request->user('sanctum');
        return $user && ($user->is_admin || $user->id === $this->id);
    }
}
