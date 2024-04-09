<?php

namespace Tests\App\Validation;

use App\Entities\UserEntity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExpenseRequestTest extends TestCase
{
    use RefreshDatabase;

    public function loginUser(): void
    {
        $user = UserEntity::factory()->create();
        $this->actingAs($user);
    }

    public function testExpenseRequestValidationRequiredFields()
    {
        $this->loginUser();

        $data = [
            'card_id' => '',
            'value' => '',
        ];

        $response = $this->postJson(route('expenses.store'), $data);

        $response->assertStatus(422);

    }

    public function testExpenseRequestValidationCardIdShouldBeInteger()
    {
        $this->loginUser();

        $data = [
            'card_id' => 'A',
            'value' => 1000,
        ];

        $response = $this->postJson(route('expenses.store'), $data);

        $response->assertStatus(422);
    }

    public function testExpenseRequestValidationValueShouldBeGreaterThanZero()
    {
        $this->loginUser();

        $data = [
            'card_id' => 1,
            'value' => 0,
        ];

        $response = $this->postJson(route('expenses.store'), $data);

        $response->assertStatus(422);

    }

    public function testExpenseRequestValidationValueShouldNotBeLessThanZero()
    {
        $this->loginUser();

        $data = [
            'card_id' => 1,
            'value' => -150,
        ];

        $response = $this->postJson(route('expenses.store'), $data);

        $response->assertStatus(422);

    }
}
