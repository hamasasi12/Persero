<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class NewPasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_displays_reset_password_view()
    {
        $response = $this->get('/reset-password?token=testtoken');

        $response->assertStatus(200);
        $response->assertViewIs('auth.reset-password');
        $response->assertViewHas('request');
    }

    public function test_store_resets_password_successfully()
    {
        Event::fake();

        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('oldpassword'),
        ]);

        Password::shouldReceive('reset')
            ->once()
            ->andReturn(Password::PASSWORD_RESET);

        $response = $this->post('/reset-password', [
            'token' => 'testtoken',
            'email' => 'test@example.com',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ]);

        $response->assertSessionHas('status', Password::PASSWORD_RESET);

        $this->assertTrue(Hash::check('newpassword', $user->refresh()->password));
        Event::assertDispatched(PasswordReset::class);
    }

    public function test_store_fails_with_invalid_token()
    {
        Password::shouldReceive('reset')
            ->once()
            ->andReturn(Password::INVALID_TOKEN);

        $response = $this->post('/reset-password', [
            'token' => 'invalidtoken',
            'email' => 'test@example.com',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors('email');
    }

    public function store_resets_password_successfully()
    {
        Event::fake();
        $user = User::factory()->create();
        $token = Password::createToken($user);

        $response = $this->post('/reset-password', [
            'token' => $token,
            'email' => $user->email,
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ]);

        // $response->assertSessionHas('status', 'Your password has been reset.');

        $this->assertTrue(Hash::check('newpassword', $user->refresh()->password));
        Event::assertDispatched(PasswordReset::class);
    }
}