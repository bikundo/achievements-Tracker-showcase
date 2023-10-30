<?php

namespace App\Achievements;

use App\Models\Achievement;

class TenLessonsWatched extends AchievementType
{
    public string $name = '10 Lessons Watched';
    public string $description = '10 Lessons Watched';
    public int $threshold = 10;
    public string $type = 'lessons';
}
