<?php

namespace Tests\App\Entities;

use App\Entities\CardEntity;
use App\Entities\ExpenseEntity;
use App\Entities\UserEntity;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class CardEntityTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testCardEntityFillableAttributes(): void
    {
        $fillableAttributes = (new CardEntity())->getFillable();

        $expectedFillableAttributes = [
            'user_id',
            'number',
            'limit',
        ];

        $this->assertEquals($expectedFillableAttributes, $fillableAttributes);
    }

    public function testCardHasManyExpensesRelationship()
    {
        $user = UserEntity::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        $card = CardEntity::create([
            'user_id' => $user->id,
            'number' => 1234567899999,
            'limit' => 1000,
        ]);

        ExpenseEntity::create([
            'card_id' => $card->id,
            'value' => 20,
        ]);

        $expenses = $card->expenses();

        $this->assertInstanceOf(HasMany::class, $expenses);
        $this->assertInstanceOf(ExpenseEntity::class, $expenses->first());
    }
}
