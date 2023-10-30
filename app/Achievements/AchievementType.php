<?php

namespace App\Achievements;

use App\Models\Achievement;

abstract class AchievementType
{

    public $model;
    public int $threshold = 1;

    public function __construct()
    {
        $this->model = Achievement::firstOrCreate([
            'name'        => $this->name,
            'threshold'   => $this->threshold,
            'description' => $this->description,
        ]);
    }

    public function modelId()
    {
        return $this->model->getKey();
    }

    public function checker($user)
    : bool {
        return $user->watched->count() >= $this->threshold;
    }
}
