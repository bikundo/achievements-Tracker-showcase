<?php

namespace App\Achievements;

use App\Models\Achievement;

class FiveLessonsWatched extends AchievementType
{
    public string $name = '5 Lessons Watched';
    public string $description = '5 Lessons Watched';
    public int $threshold = 5;

}
