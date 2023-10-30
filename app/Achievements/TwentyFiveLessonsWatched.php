<?php

namespace App\Achievements;

use App\Models\Achievement;

class TwentyFiveLessonsWatched extends AchievementType
{
    public string $name = '25 Lessons Watched';
    public string $description = '25 Lessons Watched';
    public int $threshold = 25;

}
