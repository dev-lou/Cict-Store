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
    public function customerOrders(Request $request): \Illuminate\View\View
    {
        $user = auth()->user();
        $status = $request->query('status', 'all');

        // Build base query and apply status filter if provided
        $ordersQuery = $user->orders()
            ->with('items')
            ->orderBy('created_at', 'desc');

        if (in_array($status, ['pending', 'processing', 'completed', 'cancelled'])) {
            $ordersQuery->where('status', $status);
        } else {
            $status = 'all';
        }

        $orders = $ordersQuery->paginate(10)->appends(['status' => $status]);

        // Status counts for filter chips
        $statusCounts = [
            'all' => Order::where('user_id', $user->id)->count(),
            'pending' => Order::where('user_id', $user->id)->where('status', 'pending')->count(),
            'processing' => Order::where('user_id', $user->id)->where('status', 'processing')->count(),
            'completed' => Order::where('user_id', $user->id)->where('status', 'completed')->count(),
        ];

        return view('account.orders', [
            'orders' => $orders,
            'status' => $status,
            'statusCounts' => $statusCounts,
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
