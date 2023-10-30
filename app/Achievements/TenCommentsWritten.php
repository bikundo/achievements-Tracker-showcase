<?php

namespace App\Achievements;

use App\Models\Achievement;

class TenCommentsWritten extends AchievementType
{
    public string $name = '10 Comments Written';
    public string $description = '10 Comments Written';
    public int $threshold = 10;
    public string $type = 'comments';

}
