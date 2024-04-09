<?php

namespace Tests\App\Http;

use App\Entities\UserEntity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserEndpointTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var object
     */
    private object $user;

    public function loginUserAdmin(): void
    {
        $user = UserEntity::create([
            'name' => 'Admin test',
            'email' => 'admin.test@test.com',
            'password' => Hash::make('password'),
            'password_confirmation' => Hash::make('password'),
            'is_admin' => true,
        ]);

        $this->actingAs($user);
    }

    public function createUser(): void
    {
        $this->user = UserEntity::create([
            'name' => 'Test user',
            'email' => 'test.test@test.com',
            'password' => Hash::make('password'),
            'password_confirmation' => Hash::make('password'),
            'is_admin' => false,
        ]);
    }

    public function testUserLogin()
    {
        $this->createUser();

        $data = [
            'email' => 'test.test@test.com',
            'password' => 'password',
            'device_name' => 'test'
        ];

        $response = $this->postJson(route('login'), $data);
        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['token']]);
    }

    public function testCreateNewUser()
    {
        $this->loginUserAdmin();

        $data = [
            'name' => 'Usuario test',
            'email' => 'usuario.test@teste.com',
            'password' => '123456'
        ];

        $response = $this->postJson(route('users.store'), $data);
        $response->assertStatus(201);
        $response->assertJsonStructure(['data' => ['message']]);
        $response->assertJson(['data' => ['message' => 'created successfully']]);
    }

    public function testUpdateUser()
    {
        $this->loginUserAdmin();
        $this->createUser();

        $data = [
            'name' => 'Usuario test update',
            'email' => 'usuario.test@teste.com',
            'password' => '123456'
        ];

        $response = $this->putJson(route('users.update', ['id' => $this->user->id]), $data);
        $response->assertStatus(204);
    }

    public function testDeleteUser()
    {
        $this->loginUserAdmin();
        $this->createUser();

        $response = $this->deleteJson(route('users.delete', ['id' => $this->user->id]));
        $response->assertStatus(204);
    }
}
