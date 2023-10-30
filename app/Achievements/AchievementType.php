<?php

namespace App\Achievements;

use App\Models\Achievement;

abstract class AchievementType
{

    public $model;
    public int $threshold = 1;
    public string $type;

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
        if ($this->type === 'lessons') {
            return $user->watched->count() >= $this->threshold;
        }

        return $user->comments->count() >= $this->threshold;
    }
}
