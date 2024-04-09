<?php

namespace Tests\App\Http;

use App\Entities\CardEntity;
use App\Entities\UserEntity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ExpenseEndpointTest extends TestCase
{
    use RefreshDatabase;

    public function createUser(): object
    {
        $user = UserEntity::create([
            'name' => 'Test user',
            'email' => 'test.test@test.com',
            'password' => Hash::make('password'),
            'password_confirmation' => Hash::make('password'),
            'is_admin' => false,
        ]);

        $this->actingAs($user);

        return $user;
    }

    public function createCard(int $userId): object
    {
        return CardEntity::create([
            'user_id' => $userId,
            'number' => 1234567894444,
            'limit' => 1000,
        ]);
    }

    public function testCreateNewExpenseToNotExistsCard()
    {
        $this->createUser();

        $data = [
            'card_id' => 100,
            'value' => 20
        ];

        $response = $this->postJson(route('expenses.store'), $data);
        $response->assertStatus(400);
        $response->assertJsonStructure(['error' => ['message']]);
        $response->assertJson(['error' => ['message' => 'Card not found']]);
    }

    public function testCreateNewExpenseWithValueAboveTheLimit()
    {
        $user = $this->createUser();
        $card = $this->createCard(userId: $user->id);

        $data = [
            'card_id' => $card->id,
            'value' => 200000
        ];

        $response = $this->postJson(route('expenses.store'), $data);
        $response->assertStatus(400);
        $response->assertJsonStructure(['error' => ['message']]);
        $response->assertJson(['error' => ['message' => 'You do not have enough balance to complete this transaction']]);
    }
}
