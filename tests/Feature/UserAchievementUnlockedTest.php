<?php

namespace Tests\Feature;

use App\Events\CommentWritten;
use App\Models\Comment;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Assert;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserAchievementUnlockedTest extends TestCase
{
    use RefreshDatabase;


    /**
     * A basic feature test example.
     */
    public function test_that_user_unlocks_achievement_after_posting_comment()
    : void
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->create();
        $user->comments()->save($comment);
        CommentWritten::dispatch($comment);

        $this->assertDatabaseCount('achievement_user', 1);

    }

    public function test_that_user_unlocks_first_badge_after_unlocking_first_achievement()
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
}
