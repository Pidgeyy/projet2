<?php
namespace App\Controllers\Api;

use App\Core\Auth;
use App\Core\Response;

class AuthApiController
{
    public function me()
    {
        $user = Auth::user();
        if (!$user) {
            Response::json(['message' => 'Not authenticated'], 401);
        }
        Response::json(['user' => $user]);
    }
}
