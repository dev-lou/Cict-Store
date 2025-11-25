<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a single order with tracking details.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\View\View
     */
    public function show(Order $order): \Illuminate\View\View
    {
        // Verify ownership (customer can only view their own orders)
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }
        
        // Fetch order with relationships
        $order->load('items.product', 'items.variant');

        return view('orders.show', [
            'order' => $order,
        ]);
    }

    /**
     * Cancel an order (if status is 'pending').
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel(Order $order): \Illuminate\Http\RedirectResponse
    {
        // Verify ownership
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        // Check if order can be cancelled
        if (!$order->canBeCancelled()) {
            return redirect()->back()
                ->with('error', 'Order cannot be cancelled at this stage.');
        }

        $order->update(['status' => 'cancelled']);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order has been cancelled.');
    }

    /**
     * Display customer's order history (for account page).
     *
     * @return \Illuminate\View\View
     */
    public function customerOrders(): \Illuminate\View\View
    {
        $orders = auth()->user()->orders()
            ->with('items')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('account.orders', [
            'orders' => $orders,
        ]);
    }

    /**
     * Delete an order permanently.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Order $order): \Illuminate\Http\RedirectResponse
    {
        // Verify ownership
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        $order->delete();

        return redirect()->route('account.orders')
            ->with('success', 'Order deleted successfully.');
    }
}
