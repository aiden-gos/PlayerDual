<?php

use App\Models\Order;
use App\Events\EventActionNotify;
use App\Models\User;
use App\Notifications\ActionNotify;
use App\Notifications\RentNotify;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;

test('order', function () {
    // Arrange
    Event::fake();
    Notification::fake();

    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $response = $this->actingAs($user1)->post('/rent', [
        'user_id' => $user2->id,
        'time' => 2,
        'msg' => 'test message'
    ]);

    $response->assertRedirect();

    $this->assertDatabaseHas('orders', [
        'ordering_user_id' => $user1->id,
        'ordered_user_id' => $user2->id,
        'message' => 'test message',
        'status' => 'pending',
        'price' => $user2->price,
        'duration' => 2,
        'total_price' => $user2->price * 2,
    ]);

    Event::assertDispatched(EventActionNotify::class, 2);
    Notification::assertSentTo($user2, ActionNotify::class);
    Notification::assertSentTo($user2, RentNotify::class);
});

test('err input order', function () {
    // Arrange
    Event::fake();
    Notification::fake();

    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $response = $this->actingAs($user1)->post('/rent', [
        'user_id' => $user2->id,
        'time' => "",
        'msg' => 'test message'
    ]);

    $response->assertRedirect();
    Event::assertNotDispatched(Order::class);
    Notification::assertNothingSent();
    $this->assertDatabaseMissing('orders', ['ordering_user_id' => $user1->id, 'ordered_user_id' => $user2->id]); // Check if no new order was created
});


test('order err balance', function () {
    // Arrange
    Event::fake();
    Notification::fake();

    $user1 = User::factory()->create(["balance" => 0]);
    $user2 = User::factory()->create(["price" => 10]);

    $response = $this->actingAs($user1)->post('/rent', [
        'user_id' => $user2->id,
        'time' => 2,
        'msg' => 'test message'
    ]);

    $response->assertRedirect();
    Event::assertNotDispatched(Order::class);
    Notification::assertNothingSent();
    $this->assertDatabaseMissing('orders', ['ordering_user_id' => $user1->id, 'ordered_user_id' => $user2->id]);
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
    $this->assertDatabaseHas('orders', [
        'ordering_user_id' => $user1->id,
        'ordered_user_id' => $user1->id,
        'status' => 'accepted',
        'duration' => 1,
        'message' => 'off'
    ]);
});

test('off order catch', function () {
    // Arrange
    Event::fake();
    Notification::fake();

    $user1 = User::factory()->create();

    $response = $this->actingAs($user1)->post('/off', [
        'user_id' => $user1->id,
        'time' => "",
    ]);

    $response->assertRedirect();
    $this->assertDatabaseMissing('orders', ['ordering_user_id' => $user1->id, 'ordered_user_id' => $user1->id]);
});

test('accept rent', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create([
        'balance' => 3000
    ]);
    $user2 = User::factory()->create([
        'price' => 100,
        "balance" => 2000
    ]);

    $order = Order::factory()->create([
        'ordering_user_id' => $user1->id,
        'ordered_user_id' => $user2->id,
        'status' => 'pending',
        'total_price' => $user2->price * 2,
    ]);

    $response = $this->actingAs($user1)->post('/rent/accept', [
        'id' => $order->id,
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('orders', ['id' => $order->id, 'status' => 'accepted']);
    $user1->refresh();
    $user2->refresh();
    $this->assertEquals($user1->balance, 3000 - $order->total_price);
    $this->assertEquals($user2->balance, 2000 + $order->total_price);
});

test('accept rent err input', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create();
    $order = Order::factory()->create([
        'status' => 'pending',
    ]);

    $response = $this->actingAs($user1)->post('/rent/accept', []);

    $response->assertRedirect();
    $this->assertDatabaseMissing('orders', ['id' => $order->id, 'status' => 'accepted']);
});

test('reject rent', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create();
    $order = Order::factory()->create([
        'status' => 'pending',
    ]);

    $response = $this->actingAs($user1)->post('/rent/reject', [
        'id' => $order->id,
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('orders', ['id' => $order->id, 'status' => 'rejected']);
});

test('reject rent err input', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create();
    $order = Order::factory()->create([
        'status' => 'pending',
    ]);

    $response = $this->actingAs($user1)->post('/rent/reject', []);

    $response->assertRedirect();
    $this->assertDatabaseMissing('orders', ['id' => $order->id, 'status' => 'rejected']);
});

test('end rent', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create();
    $order = Order::factory()->create([
        'status' => 'accepted',
    ]);

    $response = $this->actingAs($user1)->post('/rent/end', [
        'id' => $order->id,
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('orders', ['id' => $order->id, 'status' => 'completed']);
});

test('end rent err input', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create();
    $order = Order::factory()->create([
        'status' => 'accepted',
    ]);

    $response = $this->actingAs($user1)->post('/rent/end', []);

    $response->assertRedirect();
    $this->assertDatabaseMissing('orders', ['id' => $order->id, 'status' => 'completed']);
});
