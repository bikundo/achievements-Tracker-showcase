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


    public function test_that_user_unlocks_second_comment_achievement_after_meeting_threshold()
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->create();
        $user->comments()->save($comment);
        CommentWritten::dispatch($comment);

        $this->assertDatabaseCount('achievement_user', 1);
        $comments = Comment::factory()->createMany(2);
        $user->comments()->saveMany($comments);
        CommentWritten::dispatch($comments->last());
        $this->assertDatabaseCount('achievement_user', 2);
    }
}
