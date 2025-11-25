<x-admin-layout>
    @section('title', 'Edit Buy List Item - Admin')

    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-white mb-8" style="text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">✏️ Edit Buy List Item</h1>

        <div class="rounded-xl shadow-lg p-8" style="background: linear-gradient(135deg, #1a1f2e 0%, #0f1419 100%); border: 2px solid #2a3f5f;">
            <form action="{{ route('admin.buy-list.update', $buyListItem) }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')
                <div>
                    <label for="item_name" class="block text-sm font-semibold mb-2" style="color: #b0bcc4;">📦 Item Name</label>
                    <x-input type="text" id="item_name" name="item_name" :value="$buyListItem->item_name ?? ''" required />
                </div>
                <div>
                    <label for="quantity" class="block text-sm font-semibold mb-2" style="color: #b0bcc4;">🔢 Quantity</label>
                    <x-input type="number" id="quantity" name="quantity" :value="$buyListItem->quantity ?? ''" required />
                </div>
                <div class="flex gap-4 pt-6 border-t" style="border-color: #2a3f5f;">
                    <x-button type="submit" variant="primary">Save Changes</x-button>
                    <x-button href="{{ route('admin.buy-list.index') }}" variant="ghost">Cancel</x-button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
