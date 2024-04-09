<?php

namespace Tests\App\Validation;

use App\Entities\UserEntity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CardRequestTest extends TestCase
{
    use RefreshDatabase;

    public function loginUser(): void
    {
        $user = UserEntity::factory()->create();
        $this->actingAs($user);
    }

    public function testCardRequestValidationRequiredFields()
    {
        $this->loginUser();

        $data = [
            'user_id' => '',
            'number' => '',
            'limit' => '',
        ];

        $response = $this->postJson(route('cards.store'), $data);

        $response->assertStatus(422);

    }

    public function testCardRequestValidationUserIdShouldBeInteger()
    {
        $this->loginUser();

        $data = [
            'user_id' => 'A',
            'number' => '1234567894561',
            'limit' => 1000,
        ];

        $response = $this->postJson(route('cards.store'), $data);

        $response->assertStatus(422);
    }

    public function testCardRequestValidationNumberShouldBeBetween13and16digits()
    {
        $this->loginUser();

        $data = [
            'user_id' => 1,
            'number' => '123456789',
            'limit' => 1000,
        ];

        $response = $this->postJson(route('cards.store'), $data);

        $response->assertStatus(422);

    }

    public function testCardRequestValidationLimitShouldBeInteger()
    {
        $this->loginUser();

        $data = [
            'user_id' => 1,
            'number' => '1234567891234',
            'limit' => 'A',
        ];

        $response = $this->postJson(route('cards.store'), $data);

        $response->assertStatus(422);

    }
}
