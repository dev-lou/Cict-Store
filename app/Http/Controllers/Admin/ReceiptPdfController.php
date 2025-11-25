<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReceiptPdfController extends Controller
{
    /**
     * Display interactive receipt with PDF download functionality.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Order $order)
    {
        // Verify ownership (only admin or the order owner can view)
        if (!auth()->user()->hasRole('admin') && auth()->id() !== $order->user_id) {
            abort(403, 'Unauthorized access to receipt.');
        }

        // Load relationships for complete order data
        $order->load('items.product', 'items.variant', 'customer');

        // Return the interactive PDF page with download functionality
        return view('orders.pdf', [
            'order' => $order,
        ]);
    }
}
