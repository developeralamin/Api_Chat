<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_can_create_a_user()
    {
        $data = [
            'name'     => 'John Doe',
            'email'    => 'johndoe@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];
        $response=$this->postJson('api/register',$data);

        $response->assertStatus(201)
                ->assertJson([
                    'status'  => 'success',
                    'data'    => 'Thanks for Registration.',
                ]);
        unset($data['password'], $data['password_confirmation']);
        $this->assertDatabaseHas('users', $data);
    }


    public function test_user_can_login_successfully()
    {
        $user = User::factory()->create([
            'email'    => 'johndoee@example.com',
            'password' => bcrypt('password123'),
        ]);

        $data = [
            'email'    => 'johndoee@example.com',
            'password' => 'password123',
        ];

        $response = $this->postJson('/api/login', $data);

        $response->assertStatus(200)
          ->assertJsonStructure([
            'status',
            'data' => [
                'user' => [
                    'id',
                    'name',
                    'email',
                ],
                'token',
            ],
        ]);

    }

    public function test_user_can_try_to_login_invalid_credentials()
    {
        $user = User::factory()->create([
            'email'    => 'john@example.com',
            'password' => bcrypt('password123'),
        ]);

        $data = [
            'email'    => 'john@example.com',
            'password' => 'password12334',
        ];

        $response = $this->postJson('/api/login', $data);

        $response->assertStatus(400)
        ->assertJson([
            'status'  => 'fail',
            'message' => 'Incorrect email address or invalid credentials.',
        ]);
    }

}
