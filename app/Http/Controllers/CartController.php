<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the shopping cart.
     *
     * @return \Illuminate\View\View
     */
    public function index(): \Illuminate\View\View
    {
        $cart = session()->get('cart', []);
        $items = [];
        $subtotal = 0;

        // Reconstruct cart items with product details
        foreach ($cart as $key => $item) {
            $product = Product::find($item['product_id']);
            $variant = $item['variant_id'] ? ProductVariant::find($item['variant_id']) : null;

            if ($product) {
                $price = $variant ? $variant->getFinalPrice() : $product->base_price;
                $item_total = $price * $item['quantity'];
                $subtotal += $item_total;

                $items[] = [
                    'key' => $key,
                    'product' => $product,
                    'variant' => $variant,
                    'price' => $price,
                    'quantity' => $item['quantity'],
                    'total' => $item_total,
                ];
            }
        }

        $total = $subtotal;

        return view('cart.index', [
            'items' => $items,
            'subtotal' => $subtotal,
            'total' => $total,
        ]);
    }

    /**
     * Add an item to the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'nullable|exists:product_variants,id',
            'quantity' => 'required|integer|min:1|max:999',
        ]);

        $product = Product::find($validated['product_id']);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        // Get current cart
        $cart = session()->get('cart', []);

        // Create a unique key for this product+variant combination
        $cartKey = $validated['product_id'] . '_' . ($validated['variant_id'] ?? '0');

        // If item already in cart, update quantity
        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $validated['quantity'];
        } else {
            $cart[$cartKey] = [
                'product_id' => $validated['product_id'],
                'variant_id' => $validated['variant_id'] ?? null,
                'quantity' => $validated['quantity'],
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    /**
     * Update a cart item (quantity, etc.).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $key
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $key): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:999',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] = $validated['quantity'];
            session()->put('cart', $cart);
            return redirect()->route('cart.index');
        }

        return redirect()->route('cart.index')->with('error', 'Item not found in cart.');
    }

    /**
     * Remove an item from the cart.
     *
     * @param  string  $key
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($key): \Illuminate\Http\RedirectResponse
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$key])) {
            unset($cart[$key]);
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
        }

        return redirect()->route('cart.index')->with('error', 'Item not found in cart.');
    }

    /**
     * Clear all items from the cart.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clear(): \Illuminate\Http\RedirectResponse
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Cart cleared.');
    }
}
