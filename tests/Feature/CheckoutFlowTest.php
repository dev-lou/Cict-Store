<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutFlowTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_checkout_and_create_order_from_session_cart()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create(['current_stock' => 20, 'base_price' => 9.99]);

        // seed cart in session the same shape used by the app
        $cartKey = $product->id . '_0';
        $cartPayload = [
            $cartKey => [
                'product_id' => $product->id,
                'variant_id' => null,
                'quantity' => 3,
            ],
        ];

        $this->withSession(['cart' => $cartPayload]);

        // Post to checkout store
        $resp = $this->post(route('checkout.store'), ['notes' => 'Test order']);

        $resp->assertRedirect();

        // An order for the user should be created
        $this->assertDatabaseHas('orders', ['user_id' => $user->id]);

        // Cart should be cleared from session
        $this->assertNull(session('cart'));

        // Find the order and ensure items exist and totals are correct
        $order = Order::where('user_id', $user->id)->first();
        $this->assertNotNull($order);
        $this->assertEquals(1, $order->items()->count());

        // The order show page should be viewable by the owner
        $page = $this->get(route('orders.show', $order));
        $page->assertStatus(200);
        $this->assertStringContainsString($order->order_number, $page->getContent());
    }
}
