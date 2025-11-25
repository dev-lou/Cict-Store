<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderReceiptTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function order_owner_can_view_receipt_pdf_page()
    {
        $user = User::factory()->create();

        // Create an order with items belonging to this user
        $order = Order::factory()->for($user, 'user')->has(OrderItem::factory()->count(2), 'items')->create();

        $this->actingAs($user);

        $response = $this->get(route('orders.receipt.pdf', $order));

        $response->assertStatus(200);

        // The interactive receipt page should include the order id padded as seen in the title
        $padded = str_pad($order->id, 6, '0', STR_PAD_LEFT);
        $this->assertStringContainsString("#{$padded}", $response->getContent());
    }
}
