<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\Models\User;

class UsersController extends Controller
{
    public function show(Request $request)
    {
      return JWTAuth::parseToken()->toUser();

    }
}
