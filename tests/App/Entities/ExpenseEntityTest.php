<?php

namespace Tests\App\Entities;

use App\Entities\CardEntity;
use App\Entities\ExpenseEntity;
use App\Entities\UserEntity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class ExpenseEntityTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testExpenseEntityFillableAttributes(): void
    {
        $fillableAttributes = (new ExpenseEntity())->getFillable();

        $expectedFillableAttributes = [
            'card_id',
            'value',
        ];

        $this->assertEquals($expectedFillableAttributes, $fillableAttributes);
    }

    public function testExpenseBelongsToCardRelationship()
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

        $expense = ExpenseEntity::create([
            'card_id' => $card->id,
            'value' => 20,
        ]);

        $belongs = $expense->card();
        $this->assertInstanceOf(BelongsTo::class, $belongs);
        $this->assertInstanceOf(ExpenseEntity::class, $expense->first());
        $this->assertInstanceOf(CardEntity::class, $card->first());
    }
}
