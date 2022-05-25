<?php

namespace App\Services\V1\Auth;

use App\Http\Resources\V1\User\UserResource;
use App\Models\Kanban\Kanban;
use App\Models\User\User;
use App\Models\User\UserKanban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function register(Request $request): UserResource
    {

        $user = DB::transaction(function () use ($request) {
            $user = User::create([
                'username' => $request->get('username'),
                'email' => $request->get('email'),
                'password' => $request->get('password'),
            ]);

            $kanban = Kanban::create([
                'author_id' => $user->id,
                'name' => $user->username
            ]);

            UserKanban::create([
                'kanban_id' => $kanban->id,
                'user_id' => $user->id
            ]);

            return $user;
        });

        $token = $user->createToken(config('app.name'), ['*'])->plainTextToken;

        return new UserResource($user, $token);
    }

    public function login(Request $request): UserResource
    {
        $user = User::where('username', $request->get('username'))->first();

        if (!Hash::check($request->get('password'), $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['invalid password']
            ]);
        }

        $token = $user->createToken(config('app.name'), ['*'])->plainTextToken;

        return new UserResource($user, $token);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
    }
}
