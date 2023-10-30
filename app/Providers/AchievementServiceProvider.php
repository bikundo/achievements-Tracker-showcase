<?php

namespace App\Providers;

use App\Achievements\FiftyLessonsWatched;
use App\Achievements\FirstCommentWritten;
use App\Achievements\FirstLessonWatched;
use App\Achievements\FiveCommentsWritten;
use App\Achievements\FiveLessonsWatched;
use App\Achievements\TenCommentsWritten;
use App\Achievements\TenLessonsWatched;
use App\Achievements\ThreeCommentsWritten;
use App\Achievements\TwentyCommentsWritten;
use App\Achievements\TwentyFiveLessonsWatched;
use Illuminate\Support\ServiceProvider;

class AchievementServiceProvider extends ServiceProvider
{
    //TODO: Dynamically load and register these from their folder.
    protected array $achievements
        = [
            //lessons
            FirstLessonWatched::class,
            FiveLessonsWatched::class,
            TenLessonsWatched::class,
            TwentyFiveLessonsWatched::class,
            FiftyLessonsWatched::class,
            //comments
            FirstCommentWritten::class,
            ThreeCommentsWritten::class,
            FiveCommentsWritten::class,
            TenCommentsWritten::class,
            TwentyCommentsWritten::class,

        ];

    /**
     * Register services.
     */
    public function boot()
    : void
    {
        $this->app->singleton('achievements', function () {
            return collect($this->achievements)->map(function ($achievement) {
                return new $achievement;
            });
        });
    }

}
