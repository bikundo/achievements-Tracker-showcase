<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserAchievementsResource;
use App\Models\User;
use Illuminate\Http\Request;

class AchievementsController extends Controller
{
    public function index(User $user)
    {
        return new UserAchievementsResource($user);

    }
}
