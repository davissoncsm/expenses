<?php

namespace Database\Factories;

use App\Entities\CardEntity;
use App\Entities\UserEntity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class CardFactory extends Factory
{
    protected $model = CardEntity::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1,  UserEntity::count()),
            'number' => fake()->numberBetween(1111111111111,  9999999999999),
            'limit' => 1000,
        ];
    }
}
