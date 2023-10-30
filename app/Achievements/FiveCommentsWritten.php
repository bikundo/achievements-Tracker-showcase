<?php

namespace App\Achievements;

use App\Models\Achievement;

class FiveCommentsWritten extends AchievementType
{
    public string $name = '5 Comments Written';
    public string $description = '5 Comments Written';
    public int $threshold = 5;
    public string $type = 'comments';

}
