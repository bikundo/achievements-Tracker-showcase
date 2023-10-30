<?php

namespace App\Badges;

use App\Badges\BadgeType;

class AdvancedBadge extends BadgeType
{
    public string $name = 'Advanced';
    public string $description = 'Advanced Badge';
    public int $threshold = 8;
}
