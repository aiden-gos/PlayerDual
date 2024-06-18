<?php

use App\Models\User;

test('checkout', function () {

    $user1 = User::factory()->create([
        'balance' => 1000
    ]);
    $user2 = User::factory()->create([
        'balance' => 2000
    ]);

    $response = $this->actingAs($user1)->post('/donate', [
        'money' => 100,
        'user_id' => $user2->id,
        'msg' => 'Hello'
    ]);
    $response->assertRedirect();
    $user1->refresh();
    $user2->refresh();

    $this->assertEquals($user1->balance, 1000 - 100);
    $this->assertEquals($user2->balance, 2000 + 100);

    $this->assertDatabaseHas('donates', [
        'donating_user_id' => $user1->id,
        'donated_user_id' => $user2->id,
        'message' => 'Hello',
        'price' => 100
    ]);
});

test('checkout err balance', function () {

    $user1 = User::factory()->create([
        'balance' => 0
    ]);
    $user2 = User::factory()->create([
        'balance' => 2000
    ]);

    $response = $this->actingAs($user1)->post('/donate', [
        'money' => 100,
        'user_id' => $user2->id,
        'msg' => 'Hello'
    ]);

    $user1->refresh();
    $user2->refresh();

    $this->assertDatabaseMissing('donates', [
        'donating_user_id' => $user1->id,
        'donated_user_id' => $user2->id,
        'message' => 'Hello',
        'price' => 100
    ]);
});
