<?php

namespace App\Providers;

use App\Achievements\FiftyLessonsWatched;
use App\Achievements\FirstLessonWatched;
use App\Achievements\FiveLessonsWatched;
use App\Achievements\TenLessonsWatched;
use App\Achievements\TwentyFiveLessonsWatched;
use Illuminate\Support\ServiceProvider;

class AchievementServiceProvider extends ServiceProvider
{
    //TODO: Dynamically load and register these from their folder.
    protected array $achievements
        = [
            FirstLessonWatched::class,
            FiveLessonsWatched::class,
            TenLessonsWatched::class,
            TwentyFiveLessonsWatched::class,
            FiftyLessonsWatched::class,
        ];

    /**
     * Register services.
     */
    public function register()
    : void
    {
        $this->app->singleton('achievements', function () {
            return collect($this->achievements)->map(function ($achievement) {
                return new $achievement;
            });
        });
    }

}
