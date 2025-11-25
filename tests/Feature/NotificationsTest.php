<?php

namespace Tests\Feature;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NotificationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unread_notifications_endpoint_returns_unread_items_and_marking_works()
    {
        $user = User::factory()->create();

        // Create some unread notifications
        $n1 = Notification::create([
            'user_id' => $user->id,
            'type' => 'order_status',
            'title' => 'Order update',
            'message' => 'Your order was updated',
            'data' => ['order_id' => 123],
            'is_read' => false,
        ]);

        $n2 = Notification::create([
            'user_id' => $user->id,
            'type' => 'info',
            'title' => 'Hello',
            'message' => 'Welcome!',
            'data' => null,
            'is_read' => false,
        ]);

        $this->actingAs($user);

        // fetch unread
        $response = $this->getJson(route('notifications.unread'));
        $response->assertStatus(200);

        $json = $response->json();
        $this->assertArrayHasKey('notifications', $json);
        $this->assertGreaterThanOrEqual(2, count($json['notifications']));

        // Mark one as read
        $mark = $this->postJson(route('notifications.read', $n1));
        $mark->assertStatus(200)->assertJson(['success' => true]);

        $this->assertTrue($n1->fresh()->is_read);

        // Mark all read
        $all = $this->postJson(route('notifications.mark-all-read'));
        $all->assertStatus(200)->assertJson(['success' => true]);

        $this->assertTrue(Notification::where('user_id', $user->id)->where('is_read', true)->count() >= 2);
    }
}
