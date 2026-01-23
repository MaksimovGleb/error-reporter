<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\ErrorMessage;

class ErrorMessageTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_error_messages()
    {
        $this->get(route('error_messages.index'))->assertRedirect(route('login'));
        $this->getJson('/api/error-messages')->assertStatus(401);
    }

    public function test_user_can_view_error_messages_list()
    {
        $user = User::factory()->create();
        ErrorMessage::factory()->count(5)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get(route('error_messages.index'));

        $response->assertStatus(200);
        $response->assertSee('Error Logs');
    }

    public function test_user_can_create_error_message_via_web()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class)
            ->from(route('error_messages.create'))
            ->post(route('error_messages.store'), [
                'title' => 'Test Error',
                'description' => 'Detailed description',
                'level' => 'error',
            ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('error_messages.index'));
        $this->assertDatabaseHas('error_messages', ['title' => 'Test Error']);
    }

    public function test_user_can_create_error_message_via_api()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/error-messages', [
            'title' => 'API Error',
            'description' => 'API description',
            'level' => 'critical',
        ]);

        $response->assertStatus(201);
        $response->assertJsonPath('data.title', 'API Error');
        $response->assertJsonStructure([
            'data' => [
                'id', 'title', 'description', 'level', 'user', 'created_at', 'updated_at'
            ]
        ]);
    }

    public function test_validation_works_for_api()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/error-messages', [
            'title' => '',
            'level' => 'invalid-level',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['title', 'description', 'level']);
    }

    public function test_api_login_returns_token()
    {
        $user = User::factory()->create([
            'email' => 'api_test@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'api_test@example.com',
            'password' => 'password',
            'device_name' => 'test-device',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['token']);
    }

    public function test_api_login_fails_with_incorrect_credentials()
    {
        $user = User::factory()->create([
            'email' => 'wrong@example.com',
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'wrong@example.com',
            'password' => 'wrong-password',
            'device_name' => 'test-device',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email']);
    }
}
