<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function all(Request $request)
    {
        return [
            'users' => User::all()
        ];
    }

    public function get(Request $request, User $user)
    {
        return [
            'user' => $user
        ];
    }
}
