<?php

namespace App\Achievements;

use App\Models\Achievement;

class FirstLessonWatched extends AchievementType
{
    public string $name = 'First Lesson Watched';
    public string $description = 'First Lesson Watched';
    public int $threshold = 1;

}
