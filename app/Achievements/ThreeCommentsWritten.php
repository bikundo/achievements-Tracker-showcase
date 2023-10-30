<?php

namespace App\Achievements;

use App\Models\Achievement;

class ThreeCommentsWritten extends AchievementType
{
    public string $name = '3 Comments Written';
    public string $description = '3 Comments Written';
    public int $threshold = 3;
    public string $type = 'comments';

}
