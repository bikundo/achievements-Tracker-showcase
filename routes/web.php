<?php

use App\Http\Controllers\AchievementsController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $user = User::factory()->create();

    dd(app('achievements'));
    return view('welcome');
});

Route::get('/users/{user}/achievements', [AchievementsController::class, 'index']);
