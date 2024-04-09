<?php

namespace Tests\App\Http;

use App\Entities\CardEntity;
use App\Entities\UserEntity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CardEndpointTest extends TestCase
{

    use RefreshDatabase;

    public function createAdministrator()
    {
        $user = UserEntity::create([
            'name' => 'Admin test user',
            'email' => 'admin.test_user@test.com',
            'password' => Hash::make('password'),
            'password_confirmation' => Hash::make('password'),
            'is_admin' => true,
        ]);

        $this->actingAs($user);
        return $user;
    }

    public function createUser(bool $isLogged = true): object
    {
        $user = UserEntity::create([
            'name' => 'Test user',
            'email' => fake()->email,
            'password' => Hash::make('password'),
            'password_confirmation' => Hash::make('password'),
            'is_admin' => false,
        ]);

        if($isLogged){
            $this->actingAs($user);
        }

        return $user;
    }

    public function createCard(int $userId): object
    {
        return CardEntity::create([
            'user_id' => $userId,
            'number' => rand(1111111111111, 9999999999999),
            'limit' => 9999,
        ]);
    }

    public function testCreateNewCard()
    {
        $user = $this->createUser();

        $data = [
            'user_id' => $user->id,
            'number' => '1234567894561',
            'limit' => 1000,
        ];

        $response = $this->postJson(route('cards.store'), $data);
        $response->assertStatus(201);
        $response->assertJsonStructure(['data' => ['message']]);
        $response->assertJson(['data' => ['message' => 'created successfully']]);
    }


    public function testUpdateCard()
    {
        $user = $this->createUser();
        $card = $this->createCard($user->id);

        $data = [
            'number' => '0234567894561',
            'limit' => 500,
        ];

        $response = $this->putJson(route('cards.update', ['id' => $card->id]), $data);
        $response->assertStatus(204);
    }

    public function testDeleteCard()
    {
        $user = $this->createUser();
        $card = $this->createCard($user->id);
        $response = $this->deleteJson(route('cards.delete', ['id' => $card->id]));
        $response->assertStatus(204);
    }

    public function testIfUserIsAdminListAllCards()
    {
        $this->createAdministrator();
        $user1 = $this->createUser(isLogged: false);
        $user2 = $this->createUser(isLogged: false);

        $this->createCard($user1->id);
        $this->createCard($user2->id);

        $response = $this->getJson(route('cards.index'));
        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [['id', 'number', 'limit']]]);
        $response->assertJsonCount(2, 'data');
    }

    public function testIfUserIsNotAdminListOwnerCards()
    {
        $user1 = $this->createUser();
        $user2 = $this->createUser(isLogged: false);

        $this->createCard($user1->id);
        $this->createCard($user2->id);

        $response = $this->getJson(route('cards.index'));
        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [['id', 'number', 'limit']]]);
        $response->assertJsonCount(1, 'data');
    }

}
