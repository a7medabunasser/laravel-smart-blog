<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\post;

test('it logs in a user with valid credentials', function () {
    $user = User::factory()->create([
        'password' => Hash::make('password123'),
    ]);

    $response = post('/login', [
        'email' => $user->email,
        'password' => 'password123545', // Does not math
    ]);

    $response->assertRedirect('/dashboard/posts');
    assertAuthenticated();
});

test('it logs out an authenticated user', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = post('/dashboard/logout'); // correct /logout

    $response->assertRedirect('/');
    assertGuest();
});
