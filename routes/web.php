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
   app('achievements');
    $user = User::with('achievements')->find(1);
    $comment = \App\Models\Comment::factory()->createOne();
    $user->comments()->save($comment);
    $user->lessons()->syncWithPivotValues([1, 2, 3], ['watched' => true]);
   // $user->achievements()->sync([1, 2, 3]);

    \App\Events\CommentWritten::dispatch($comment);
    $user = $user->fresh(['achievements']);
    //dd($user);
    //dd($user->achievementIds);


    return view('welcome');
});

Route::get('/users/{user}/achievements', [AchievementsController::class, 'index']);
