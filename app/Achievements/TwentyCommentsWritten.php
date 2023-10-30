<?php

namespace App\Achievements;

use App\Models\Achievement;

class TwentyCommentsWritten extends AchievementType
{
    public string $name = '20 Comments Written';
    public string $description = '20 Comments Written';
    public int $threshold = 20;
    public string $type = 'comments';

}
