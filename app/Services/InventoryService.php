<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\InventoryHistory;
use Illuminate\Support\Facades\DB;

class InventoryService
{
    /**
     * Get total stock for a product from all active variants.
     */
    public function getTotalProductStock(Product $product): int
    {
        return $product->variants()
            ->where('status', 'active')
            ->sum('stock_quantity');
    }

    /**
     * Check if product has stock.
     */
    public function hasProductStock(Product $product): bool
    {
        return $this->getTotalProductStock($product) > 0;
    }

    /**
     * Get stock status badge for a product.
     */
    public function getStockStatus(Product $product): string
    {
        $totalStock = $this->getTotalProductStock($product);

        if ($totalStock > 20) {
            return 'in-stock';
        } elseif ($totalStock > 0) {
            return 'low-stock';
        } else {
            return 'out-of-stock';
        }
    }

    /**
     * Get stock status label.
     */
    public function getStockStatusLabel(Product $product): string
    {
        $status = $this->getStockStatus($product);
        return match ($status) {
            'in-stock' => 'In Stock',
            'low-stock' => 'Low Stock',
            'out-of-stock' => 'Out of Stock',
            default => 'Unknown',
        };
    }

    /**
     * Get variant stock status.
     */
    public function getVariantStockStatus(ProductVariant $variant): string
    {
        $stock = $variant->stock_quantity;

        if ($stock > 20) {
            return 'in-stock';
        } elseif ($stock > 0) {
            return 'low-stock';
        } else {
            return 'out-of-stock';
        }
    }

    /**
     * Process stock-in for a variant.
     */
    public function stockInVariant(
        ProductVariant $variant,
        int $quantity,
        string $reference,
        ?string $notes = null,
        ?int $userId = null
    ): InventoryHistory {
        return DB::transaction(function () use ($variant, $quantity, $reference, $notes, $userId) {
            $oldStock = $variant->stock_quantity;
            
            // Update variant stock
            $variant->increment('stock_quantity', $quantity);
            
            // Create history record
            return InventoryHistory::create([
                'product_id' => $variant->product_id,
                'variant_id' => $variant->id,
                'user_id' => $userId ?? auth()->id(),
                'type' => 'stock_in',
                'quantity_changed' => $quantity,
                'quantity_before' => $oldStock,
                'quantity_after' => $oldStock + $quantity,
                'reference' => $reference,
                'notes' => $notes,
            ]);
        });
    }

    /**
     * Process stock-out for a variant.
     */
    public function stockOutVariant(
        ProductVariant $variant,
        int $quantity,
        string $reason,
        ?string $notes = null,
        ?int $userId = null
    ): InventoryHistory {
        if ($quantity > $variant->stock_quantity) {
            throw new \Exception("Insufficient stock. Available: {$variant->stock_quantity}, Requested: {$quantity}");
        }

        return DB::transaction(function () use ($variant, $quantity, $reason, $notes, $userId) {
            $oldStock = $variant->stock_quantity;
            
            // Update variant stock
            $variant->decrement('stock_quantity', $quantity);
            
            // Create history record
            return InventoryHistory::create([
                'product_id' => $variant->product_id,
                'variant_id' => $variant->id,
                'user_id' => $userId ?? auth()->id(),
                'type' => 'stock_out',
                'quantity_changed' => -$quantity,
                'quantity_before' => $oldStock,
                'quantity_after' => $oldStock - $quantity,
                'reference' => $reason,
                'notes' => $notes,
            ]);
        });
    }

    /**
     * Get low stock variants for a product.
     */
    public function getLowStockVariants(Product $product, int $threshold = 10): \Illuminate\Database\Eloquent\Collection
    {
        return $product->variants()
            ->where('status', 'active')
            ->where('stock_quantity', '<=', $threshold)
            ->get();
    }

    /**
     * Get out of stock variants for a product.
     */
    public function getOutOfStockVariants(Product $product): \Illuminate\Database\Eloquent\Collection
    {
        return $product->variants()
            ->where('status', 'active')
            ->where('stock_quantity', 0)
            ->get();
    }

    /**
     * Get inventory history for a variant.
     */
    public function getVariantHistory(ProductVariant $variant, int $limit = 20): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return InventoryHistory::where('variant_id', $variant->id)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate($limit);
    }

    /**
     * Get total stock adjustments for a variant.
     */
    public function getVariantAdjustments(ProductVariant $variant): array
    {
        $stockIn = InventoryHistory::where('variant_id', $variant->id)
            ->where('type', 'stock_in')
            ->sum('quantity_changed');

        $stockOut = InventoryHistory::where('variant_id', $variant->id)
            ->where('type', 'stock_out')
            ->sum('quantity_changed');

        return [
            'total_in' => $stockIn,
            'total_out' => abs($stockOut),
            'net_change' => $stockIn + $stockOut, // stockOut is negative
        ];
    }
}
