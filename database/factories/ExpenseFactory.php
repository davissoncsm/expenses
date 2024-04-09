<?php

namespace Database\Factories;

use App\Entities\CardEntity;
use App\Entities\ExpenseEntity;
use App\Entities\UserEntity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class ExpenseFactory extends Factory
{
    protected $model = ExpenseEntity::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'card_id' => fake()->numberBetween(1,  CardEntity::count()),
            'value' => 20,
        ];
    }
}
