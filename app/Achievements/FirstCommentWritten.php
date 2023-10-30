<?php

namespace App\Achievements;

use App\Models\Achievement;

class FirstCommentWritten extends AchievementType
{
    public string $name = 'First Comment Written';
    public string $description = 'First Comment Written';
    public int $threshold = 1;
    public string $type = 'comments';

}
