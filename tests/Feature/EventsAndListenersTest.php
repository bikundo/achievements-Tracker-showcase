<?php

namespace Tests\Feature;

use App\Events\AchievementUnlocked;
use App\Events\CommentWritten;
use App\Events\LessonWatched;
use App\Listeners\AchievementsListener;
use App\Listeners\AchievementUnlockedListener;
use App\Models\Comment;
use App\Models\Lesson;
use App\Models\User;
use Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventsAndListenersTest extends TestCase
{
    use RefreshDatabase;

    public function test_that_events_have_correct_listeners()
    : void
    {

        Event::fake();
        Event::assertListening(
            CommentWritten::class,
            AchievementsListener::class
        );
        Event::assertListening(
            LessonWatched::class,
            AchievementsListener::class
        );
        Event::assertListening(
            AchievementUnlocked::class,
            AchievementUnlockedListener::class
        );

    }

    public function test_correct_event_are_fired()
    : void
    {
        Event::fake();


        $user = User::factory()->create();
        $comment = Comment::factory()->create();
        $lesson = Lesson::factory()->create();
        $user->comments()->save($comment);
        CommentWritten::dispatch($comment);

        Event::assertDispatched(CommentWritten::class, function ($e) use ($comment) {
            return $e->comment->id === $comment->id;
        });
        LessonWatched::dispatch($lesson, $user);
        Event::assertDispatched(LessonWatched::class, function ($e) use ($user, $lesson) {
            return $e->lesson->id === $lesson->id && $e->user->id === $user->id;
        });

    }
}
