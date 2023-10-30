<?php

namespace App\Providers;

use App\Badges\AdvancedBadge;
use App\Badges\BeginnerBadge;
use App\Badges\IntermediateBadge;
use App\Badges\MasterBadge;
use Illuminate\Support\ServiceProvider;

class BadgeServiceProvider extends ServiceProvider
{
    protected array $badges
        = [
            BeginnerBadge::class,
            IntermediateBadge::class,
            AdvancedBadge::class,
            MasterBadge::class,
        ];

    /**
     * Register services.
     */
    public function register()
    : void
    {
        $this->app->singleton('badges', function () {
            return collect($this->badges)->map(function ($badge) {
                return new $badge;
            });
        });
    }

}
