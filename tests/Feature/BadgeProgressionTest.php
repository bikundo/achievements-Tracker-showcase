<?php

namespace Tests\Feature;

use App\Events\AchievementUnlocked;
use App\Events\CommentWritten;
use App\Models\Achievement;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BadgeProgressionTest extends TestCase
{
    public function test_that_user_unlocks_first_badge_after_unlocking_first_comment_achievement()
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->create();
        $user->comments()->save($comment);
        CommentWritten::dispatch($comment);

        $response = $this->getJson("/users/{$user->id}/achievements");
        $response->assertJson([
            'current_badge' => 'Beginner',
        ]);

    }

    public function test_that_user_gets_second_badge_as_current_badge_when_they_meet_threshold()
    {

        $user = User::factory()->create();
        $comment = Comment::factory()->create();
        $user->comments()->save($comment);
        CommentWritten::dispatch($comment);

        $response = $this->getJson("/users/{$user->id}/achievements");
        $response->assertJson([
            'current_badge' => 'Beginner',
        ]);
        $achievements = Achievement::take(4)->get();
        $user->achievements()->sync($achievements->pluck('id'));
        $user->refresh();
        AchievementUnlocked::dispatch($achievements->last()->name, $user);
        $response = $this->getJson("/users/{$user->id}/achievements");
        $response->assertJson([
            'current_badge' => 'Intermediate',
        ]);
    }
}
