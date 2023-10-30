<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserAchievementsEndpointTest extends TestCase
{

    public function test_the_endpoint_returns_a_successful_response()
    : void
    {
        $user = User::factory()->create();

        $response = $this->getJson("/users/{$user->id}/achievements");

        $response->assertStatus(200);


    }

    public function test_that_endpoint_returns_correct_json_structure()
    {
        $user = User::factory()->create();

        $response = $this->getJson("/users/{$user->id}/achievements");

        $response->assertStatus(200);

        $response->assertJson(fn(AssertableJson $json) => $json->hasAll([
            'unlocked_achievements',
            'next_available_achievements',
            'current_badge',
            'next_badge',
            'remaining_to_unlock_next_badge',
        ]));

        $response->assertJson(fn(AssertableJson $json) => $json
            ->whereType('current_badge', 'string|null')
            ->whereType('next_badge', 'string|null')
            ->whereType('unlocked_achievements', 'array')
            ->whereType('remaining_to_unlock_next_badge', 'integer')
            ->whereType('next_available_achievements', 'array')
        );

    }
}
