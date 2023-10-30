<?php

namespace App\Achievements;

use App\Models\Achievement;

abstract class AchievementType
{

    public $model;
    public int $threshold = 1;
    public string $type;
    public string $name;
    public string $description;

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

    public function checker($user, $type)
    : bool {
        if ($type !== $this->type) {
            return false;
        }
        if ($this->type === 'lessons') {
            return $user->watched->count() >= $this->threshold;
        } elseif ($this->type === 'comments') {
            return $user->comments->count() >= $this->threshold;
        }

        return false;
    }
}
