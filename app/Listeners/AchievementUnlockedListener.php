<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;
use App\Models\Achievement;
use App\Models\Badge;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;

class AchievementUnlockedListener
{
    private User $user;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AchievementUnlocked $event)
    : void {
        //Go through all badges and check if the user meets the threshold and return their ids
        $this->user = $event->user;
        $allUnlockedBadges = $this->getUnlockedBadges($event);
        $userCurrentBadges = $this->user->badgeIds;
        $newBadge = $allUnlockedBadges->diff($userCurrentBadges)->first();
        if ($newBadge) {

            $this->user->badges()->syncWithPivotValues($userCurrentBadges, ['current' => false]);
            $this->user->badges()->attach($newBadge, ['current' => true]);

            $badge = Badge::find($newBadge);
            $this->user->refresh();
            BadgeUnlocked::dispatch($badge->name, $this->user);
        }
    }

    /**
     * @param  AchievementUnlocked  $event
     *
     * @return mixed
     */
    public function getUnlockedBadges(AchievementUnlocked $event)
    : mixed {
        return app('badges')->filter(function ($badge) use ($event) {
            return $badge->checker($this->user);
        })->map(function ($badge) {
            return $badge->modelId();
        });
    }
}
