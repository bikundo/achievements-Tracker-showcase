<?php

namespace App\Badges;

use App\Badges\BadgeType;

class MasterBadge extends BadgeType
{
    public string $name = 'Master';
    public string $description = 'Master Badge';
    public int $threshold = 10;
}
