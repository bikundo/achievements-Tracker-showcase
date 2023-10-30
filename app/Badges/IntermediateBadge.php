<?php

namespace App\Badges;

use App\Badges\BadgeType;

class IntermediateBadge extends BadgeType
{
    public string $name = 'Intermediate';
    public string $description = 'Intermediate Badge';
    public int $threshold = 4;
}
