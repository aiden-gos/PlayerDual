<?php

use App\Models\Order;
use App\Events\EventActionNotify;
use App\Models\User;
use Illuminate\Support\Facades\Event;

test('fires event action notify for each order', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $response = $this->actingAs($user1)->post('/rent', [
        'user_id' => $user2->id,
        'time' => 2,
        'msg' => 'test message'
    ]);

    $response->assertRedirect();
});

test('fires each order', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $response = $this->actingAs($user1)->post('/rent', [
        'user_id' => $user2->id,
        'time' => "",
        'msg' => 'test message'
    ]);

    $response->assertRedirect();
});


test('order err balance', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create(["balance" => 0]);
    $user2 = User::factory()->create(["price" => 10]);

    $response = $this->actingAs($user1)->post('/rent', [
        'user_id' => $user2->id,
        'time' => 2,
        'msg' => 'test message'
    ]);

    $response->assertRedirect();
});

test('off order', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create();

    $response = $this->actingAs($user1)->post('/off', [
        'user_id' => $user1->id,
        'time' => 1,
    ]);

    $response->assertRedirect();
});

test('off order catch', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create();

    $response = $this->actingAs($user1)->post('/off', [
        'user_id' => $user1->id,
        'time' => "",
    ]);

    $response->assertRedirect();
});

test('accept rent', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create();
    $order = Order::factory()->create();

    $response = $this->actingAs($user1)->post('/rent/accept', [
        'id' => $order->id,
    ]);

    $response->assertRedirect();
});

test('accept rent err input', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create();
    $order = Order::factory()->create();

    $response = $this->actingAs($user1)->post('/rent/accept', [
        'id' => "",
    ]);

    $response->assertRedirect();
});

test('reject rent', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create();
    $order = Order::factory()->create();

    $response = $this->actingAs($user1)->post('/rent/reject', [
        'id' => $order->id,
    ]);

    $response->assertRedirect();
});

test('reject rent err input', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create();
    $order = Order::factory()->create();

    $response = $this->actingAs($user1)->post('/rent/reject', [
        'id' => "",
    ]);

    $response->assertRedirect();
});


test('end rent', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create();
    $order = Order::factory()->create();

    $response = $this->actingAs($user1)->post('/rent/reject', [
        'id' => $order->id,
    ]);

    $response->assertRedirect();
});

test('end rent err input', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create();
    $order = Order::factory()->create();

    $response = $this->actingAs($user1)->post('/rent/end', [
        'id' => "",
    ]);

    $response->assertRedirect();
});
