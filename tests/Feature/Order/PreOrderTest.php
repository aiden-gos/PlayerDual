<?php

use App\Models\Order;
use App\Events\EventActionNotify;
use App\Models\User;
use App\Notifications\ActionNotify;
use App\Notifications\RentNotify;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;

test('pre-order', function () {
    // Arrange
    Event::fake();
    Notification::fake();

    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $response = $this->actingAs($user1)->post('/pre-order', [
        'user_id' => $user2->id,
        'time' => 2,
        'msg' => 'test message'
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('orders', [
        'ordering_user_id' => $user1->id,
        'ordered_user_id' => $user2->id,
        'message' => 'test message',
        'status' => 'pre-ordering',
        'price' => $user2->price,
        'duration' => 2,
        'total_price' => $user2->price * 2,
    ]);

    Event::assertDispatched(EventActionNotify::class, 2);
    Notification::assertSentTo($user2, ActionNotify::class);
    Notification::assertSentTo($user2, RentNotify::class);
});

test('err input pre-order', function () {
    // Arrange
    Event::fake();
    Notification::fake();

    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $response = $this->actingAs($user1)->post('/pre-order', [
        'user_id' => $user2->id,
        'time' => "",
        'msg' => 'test message'
    ]);

    $response->assertRedirect();
    Event::assertNotDispatched(Order::class);
    Notification::assertNothingSent();
    $this->assertDatabaseMissing('orders', ['ordering_user_id' => $user1->id, 'ordered_user_id' => $user2->id]);
});


test('pre-order err balance', function () {
    // Arrange
    Event::fake();
    Notification::fake();

    $user1 = User::factory()->create(["balance" => 0]);
    $user2 = User::factory()->create(["price" => 10]);

    $response = $this->actingAs($user1)->post('/pre-order', [
        'user_id' => $user2->id,
        'time' => 2,
        'msg' => 'test message'
    ]);

    $response->assertRedirect();
    Event::assertNotDispatched(Order::class);
    Notification::assertNothingSent();
    $this->assertDatabaseMissing('orders', ['ordering_user_id' => $user1->id, 'ordered_user_id' => $user2->id]);
});

test('accept pre-order', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create([
        'balance' => 3000
    ]);
    $user2 = User::factory()->create([
        'price' => 100,
        "balance" => 2000
    ]);

    $old_order = Order::factory()->create([
        'ordering_user_id' => $user2->id,
        'ordered_user_id' => $user2->id,
        'status' => 'accepted',
        'total_price' => 0,
    ]);

    $order = Order::factory()->create([
        'ordering_user_id' => $user1->id,
        'ordered_user_id' => $user2->id,
        'status' => 'pre-ordering',
        'total_price' => $user2->price * 2,
    ]);

    $response = $this->actingAs($user1)->post('/pre-order/accept', [
        'id' => $order->id,
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('orders', ['id' => $order->id, 'status' => 'pre-ordered']);
    $user1->refresh();
    $user2->refresh();
    $this->assertEquals($user1->balance, 3000 - $order->total_price);
    $this->assertEquals($user2->balance, 2000 + $order->total_price);
});

test('accept pre-order err input', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create();
    $order = Order::factory()->create([
        'status' => 'pre-ordering',
    ]);

    $response = $this->actingAs($user1)->post('/pre-order/accept', [
        'id' => "",
    ]);

    $response->assertRedirect();
    $this->assertDatabaseMissing('orders', ['id' => $order->id, 'status' => 'pre-orded']);
});

test('reject pre-order', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create();
    $order = Order::factory()->create([
        'status' => 'pre-ordering',
    ]);

    $response = $this->actingAs($user1)->post('/pre-order/reject', [
        'id' => $order->id,
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('orders', ['id' => $order->id, 'status' => 'rejected']);
});

test('reject pre-order err input', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create();
    $order = Order::factory()->create([
        'status' => 'pre-ordering',
    ]);

    $response = $this->actingAs($user1)->post('/pre-order/reject', [
        'id' => "",
    ]);

    $response->assertRedirect();
    $this->assertDatabaseMissing('orders', ['id' => $order->id, 'status' => 'rejected']);
});

test('end pre-order', function () {
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
        'status' => 'pre-ordering',
        'total_price' => $user2->price * 2,
        'start_at' => date('Y-m-d H:i:s', strtotime("+31 minutes")),
    ]);

    $response = $this->actingAs($user1)->post('/pre-order/end', [
        'id' => $order->id,
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('orders', ['id' => $order->id, 'status' => 'completed']);
    $user1->refresh();
    $user2->refresh();
    $this->assertEquals($user1->balance, 3000 + $order->total_price);
    $this->assertEquals($user2->balance, 2000 - $order->total_price);
});

test('end pre-order err input', function () {
    // Arrange
    Event::fake();

    $user1 = User::factory()->create();
    $order = Order::factory()->create([
        'status' => 'pre-ordering',
    ]);

    $response = $this->actingAs($user1)->post('/pre-order/end', [
        'id' => "",
    ]);

    $response->assertRedirect();
});
