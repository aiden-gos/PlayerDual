<?php

use App\Models\Donate;
use App\Models\Gallery;
use App\Models\User;

test('get user page', function () {
    $user = User::factory()->create();
    $gallery = Gallery::factory()->count(5)->create(['user_id' => $user->id]);

    $response = $this->actingAs($user)->get('/user/' . $user->id);

    $response->assertStatus(200);
    $response->assertViewIs('user');
    $response->assertViewHas('user', $user);
    $response->assertViewHas('gallery', $gallery);
});
