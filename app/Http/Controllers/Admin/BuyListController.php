<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BuyListItem;
use Illuminate\Http\Request;

class BuyListController extends Controller
{
    /**
     * Display the buy list (to-buy items).
     *
     * @return \Illuminate\View\View
     */
    public function index(): \Illuminate\View\View
    {
        $items = BuyListItem::orderBy('priority', 'asc')->orderBy('created_at', 'desc')->get();

        // derive any custom field keys that exist across items so the UI can render those columns
        $customKeys = $items->pluck('custom_fields')
            ->filter()
            ->flatMap(function ($arr) { return is_array($arr) ? array_keys($arr) : []; })
            ->unique()
            ->values()
            ->all();

        return view('admin.buy-list.index', compact('items', 'customKeys'));
    }

    /**
     * Store a new buy list item via AJAX.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'nullable|integer|min:1',
            'estimated_price_min' => 'nullable|numeric|min:0',
            'estimated_price_max' => 'nullable|numeric|min:0',
            'priority' => 'required|in:low,medium,high',
            'is_bought' => 'nullable|boolean',
            'custom_fields' => 'nullable|array',
            'notes' => 'nullable|string',
        ]);

        $item = BuyListItem::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Item added successfully!',
            'item' => $item
        ]);
    }

    /**
     * Update a buy list item via AJAX.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $item = BuyListItem::findOrFail($id);

        $validated = $request->validate([
            'item_name' => 'sometimes|string|max:255',
            'quantity' => 'nullable|integer|min:1',
            'estimated_price_min' => 'nullable|numeric|min:0',
            'estimated_price_max' => 'nullable|numeric|min:0',
            'priority' => 'sometimes|in:low,medium,high',
            'is_bought' => 'nullable|boolean',
            'notes' => 'nullable|string',
            'custom_fields' => 'nullable|array',
        ]);

        // If custom_fields is present, merge it into stored JSON so we preserve other keys
        if (isset($validated['custom_fields']) && is_array($validated['custom_fields'])) {
            $existing = $item->custom_fields ?? [];
            $merged = array_merge($existing, $validated['custom_fields']);
            $validated['custom_fields'] = $merged;
        }

        $item->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Item updated successfully!',
            'item' => $item
        ]);
    }

    /**
     * Delete a buy list item via AJAX.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $item = BuyListItem::findOrFail($id);
        $item->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item deleted successfully!'
        ]);
    }

}
