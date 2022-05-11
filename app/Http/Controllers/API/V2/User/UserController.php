<?php

namespace App\Http\Controllers\API\V2\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function all(Request $request)
    {
        return [
            'random' => 'users'
        ];
    }
}
