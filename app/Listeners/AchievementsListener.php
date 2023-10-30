<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Events\CommentWritten;
use App\Events\LessonWatched;
use App\Models\Achievement;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AchievementsListener
{
    private User $user;
    private string $type;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(LessonWatched|CommentWritten $event)
    : void {
        //Go through all achievements and check if the user meets the threshold and return their ids
        $this->user = $this->getEventUserModel($event);
        $allUnlockedAchievements = $this->getUnlockedAchievements($event);
        $currentAchievementIds = $this->user->achievementIds;
        $newAchievements = $allUnlockedAchievements->diff($currentAchievementIds);

        if ($newAchievements->count()) {
            $this->user->achievements()->syncWithoutDetaching($newAchievements->all());
            foreach ($newAchievements as $newAchievement) {
                $achievement = Achievement::find($newAchievement);
                $this->user->refresh();
                AchievementUnlocked::dispatch($achievement->name, $this->user);
            }
        }

    }

    // retrieve the user model for the event and set the type of event
    private function getEventUserModel(LessonWatched|CommentWritten $event)
    {
        if ($event instanceof CommentWritten) {
            $this->type = 'comments';

            return $event->comment->user;
        }
        $this->type = 'lessons';

        return $event->user;
    }

    /**
     * @param  LessonWatched|CommentWritten  $event
     *
     * @return mixed
     */
    private function getUnlockedAchievements(LessonWatched|CommentWritten $event)
    : mixed {
        return app('achievements')->filter(function ($achievement) use ($event) {
            return $achievement->checker($this->user, $this->type);
        })->map(function ($achievement) {
            return $achievement->modelId();
        });
    }
}
