<?php

namespace App\Badges;

use App\Badges\BadgeType;

class BeginnerBadge extends BadgeType
{
    public string $name = 'Beginner';
    public string $description = 'Beginner Badge';
    public int $threshold = 0;
}
