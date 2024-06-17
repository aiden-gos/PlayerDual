<?php

use App\Models\Order;
use App\Events\EventActionNotify;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

test('pre-order', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $response = $this->actingAs($user1)->post('/pre-order', [
        'user_id' => $user2->id,
        'time' => 2,
        'msg' => 'test message'
    ]);

    $response->assertRedirect();
});

test('fires each pre-order', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $response = $this->actingAs($user1)->post('/pre-order', [
        'user_id' => $user2->id,
        'time' => "",
        'msg' => 'test message'
    ]);

    $response->assertRedirect();
});


test('pre-order err balance', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create(["balance" => 0]);
    $user2 = User::factory()->create(["price" => 10]);

    $response = $this->actingAs($user1)->post('/pre-order', [
        'user_id' => $user2->id,
        'time' => 2,
        'msg' => 'test message'
    ]);

    $response->assertRedirect();
});

test('accept pre-order', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create();
    $order = Order::factory()->create();

    $response = $this->actingAs($user1)->post('/pre-order/accept', [
        'id' => $order->id,
    ]);

    $response->assertRedirect();
});

test('accept pre-order err input', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create();
    $order = Order::factory()->create();

    $response = $this->actingAs($user1)->post('/pre-order/accept', [
        'id' => "",
    ]);

    $response->assertRedirect();
});

test('reject pre-order', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create();
    $order = Order::factory()->create();

    $response = $this->actingAs($user1)->post('/pre-order/reject', [
        'id' => $order->id,
    ]);

    $response->assertRedirect();
});

test('reject pre-order err input', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create();
    $order = Order::factory()->create();

    $response = $this->actingAs($user1)->post('/pre-order/reject', [
        'id' => "",
    ]);

    $response->assertRedirect();
});


test('end pre-order', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create();
    $order = Order::factory()->create();

    $response = $this->actingAs($user1)->post('/pre-order/reject', [
        'id' => $order->id,
    ]);

    $response->assertRedirect();
});

test('end pre-order err input', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create();
    $order = Order::factory()->create();

    $response = $this->actingAs($user1)->post('/pre-order/end', [
        'id' => "",
    ]);

    $response->assertRedirect();
});
