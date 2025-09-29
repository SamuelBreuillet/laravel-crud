<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user = User::query()
            ->select('email', 'password')
            ->where('email', $validated['email'])
            ->first();

        abort_if(!$user || !Hash::check($validated['password'], $user->password), Response::HTTP_UNPROCESSABLE_ENTITY);

        $token = $user->createToken(
            config('app.name')
        );

        return response()->json([
            'token' => $token->plainTextToken
        ]);
    }
}
