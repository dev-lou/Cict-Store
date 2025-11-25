<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartFlowTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function adding_a_product_to_cart_updates_session_and_cart_page_shows_item()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create(['name' => 'Sample Product', 'current_stock' => 10]);

        // Post to cart store
        $response = $this->post(route('cart.store'), [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $response->assertStatus(302); // redirect back on success

        // Cart session should exist and contain item
        $this->assertNotEmpty(session('cart'));

        $cartKey = $product->id . '_0';
        $this->assertArrayHasKey($cartKey, session('cart'));
        $this->assertEquals(2, session('cart')[$cartKey]['quantity']);

        // Visiting cart index should render and show product name
        $page = $this->get(route('cart.index'));
        $page->assertStatus(200);
        $this->assertStringContainsString('Sample Product', $page->getContent());
    }
}
