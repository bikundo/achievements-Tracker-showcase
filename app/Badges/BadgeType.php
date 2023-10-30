<?php

namespace App\Badges;

use App\Models\Achievement;
use App\Models\Badge;

abstract class BadgeType
{

    public $model;
    public int $threshold = 0;
    public string $name;
    public string $description;


    public function __construct()
    {
        $this->model = Badge::firstOrCreate([
            'name'        => $this->name,
            'threshold'   => $this->threshold,
            'icon'        => 'path/to/icon.svg',
            'description' => $this->description,
        ]);
    }

    public function modelId()
    {
        return $this->model->getKey();
    }

    public function checker($user)
    : bool {

        return $user->achievements->count() >= $this->threshold;

    }
}
