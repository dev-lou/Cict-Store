<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RouteParametersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function product_show_page_renders_and_review_form_has_product_parameter()
    {
        // Create a product
        $product = Product::factory()->create();

        // Make a user who has a completed order for this product so the review form shows
        $user = \App\Models\User::factory()->create();
        $order = \App\Models\Order::factory()
            ->for($user, 'user')
            ->has(\App\Models\OrderItem::factory()->state(['product_id' => $product->id]), 'items')
            ->create(['status' => 'completed']);

        $this->actingAs($user);

        // Visit the product detail page
        $response = $this->get(route('shop.show', $product));

        // Page should render successfully
        $response->assertStatus(200);

        // The review form action should contain the product's slug (route uses product model binding)
        $this->assertStringContainsString("/products/{$product->slug}/reviews", $response->getContent());
    }
}
