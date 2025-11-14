<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlockedUserLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_blocked_user_cannot_authenticate(): void
    {
        $user = User::factory()->create([
            'email' => 'blocked@example.com',
            'password' => bcrypt('password'),
            'is_active' => false,
        ]);

        $response = $this->from('/login')->post('/login', [
            'login' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors([
            'login' => trans('auth.blocked'),
        ]);

        $this->assertGuest();
    }
}
