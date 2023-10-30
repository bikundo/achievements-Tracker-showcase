<?php

namespace App\Http\Resources;

use App\Models\Achievement;
use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAchievementsResource extends JsonResource
{
    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    : array {
        return [
            'unlocked_achievements'          => $this->achievements->pluck('name'),
            'next_available_achievements'    => $this->nextAvailableAchievements,
            'current_badge'                  => $this->currentBadge()?->name,
            'next_badge'                     => $this->nextbadge,
            'remaining_to_unlock_next_badge' => $this->RemainingBadgeCount,
        ];
    }
}
