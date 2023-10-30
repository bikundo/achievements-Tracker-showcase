<?php

namespace App\Achievements;

use App\Models\Achievement;

class FiftyLessonsWatched extends AchievementType
{
    public string $name = '50 Lessons Watched';
    public string $description = '50 Lessons Watched';
    public int $threshold = 50;
    public string $type = 'lessons';

}
