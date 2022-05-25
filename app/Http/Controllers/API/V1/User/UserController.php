<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Services\V1\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }

    public function getKanbans(Request $request)
    {
        $kanbans = $this->userService->kanbans($request);

        return $kanbans;
    }
}
