<?php

namespace Tests\Feature;

use App\Http\Middleware\VerifyCsrfToken;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ChangePasswordTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPasswordChangeTest()
    {
        $old_password = 'secret';
        $user = factory(User::class)->create(['password' => Hash::make($old_password)]);
        $this->be($user);
        $response = $this->get(route('change-password.show'));
        $response->assertStatus(200);

        $password = $this->faker->password;
        $payload = [
            'old_password' => $old_password,
            'password' => $password,
            'password_confirmation' => $password,
        ];

        $this->withoutMiddleware(VerifyCsrfToken::class);
        $this->post(route('change-password.update'), $payload);
        $user->fresh();
        $this->assertTrue(Hash::check($payload['password'], $user->password));
    }
}
