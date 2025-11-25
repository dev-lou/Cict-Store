<x-modal id="stock-in-modal" title="Receive Stock" size="lg">
    @slot('trigger')
        <x-button variant="primary" size="sm" style="background-color: #8b0000; border: 2px solid #daa520; color: white; border-radius: 12px; font-weight: 600; padding: 10px 16px; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#a50000'; this.style.boxShadow='0 8px 16px rgba(138, 0, 0, 0.4)';" onmouseout="this.style.backgroundColor='#8b0000'; this.style.boxShadow='none';">+ Stock In</x-button>
    @endslot

    <form id="stock-in-form" action="{{ route('admin.inventory.stock.storeIn') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Product Selection -->
        <div class="group">
            <label class="block text-sm font-semibold mb-3" style="color: #ffd700; text-transform: uppercase; letter-spacing: 0.5px;">Product <span style="color: #a50000;">*</span></label>
            <select 
                name="product_id" 
                required
                class="w-full px-5 py-3 border-2 rounded-lg focus:outline-none transition-all duration-300 font-medium"
                style="background-color: #2d1515; border-color: #daa520; color: #ffd700; border-radius: 10px;"
                onfocus="this.style.borderColor='#ffd700'; this.style.boxShadow='0 0 12px rgba(255, 215, 0, 0.3)';" 
                onblur="this.style.borderColor='#daa520'; this.style.boxShadow='none';"
            >
                <option value="" style="background-color: #2d1515; color: #ffd700;">Select a product...</option>
                @isset($products)
                    @foreach ($products as $product)
                    <option value="{{ $product->id }}" style="background-color: #2d1515; color: #ffd700;">{{ $product->name }} (Current: {{ $product->current_stock }})</option>
                @endforeach
                @endisset
            </select>
            @error('product_id')
                <p style="color: #a50000;" class="text-xs mt-2 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <!-- Quantity -->
        <div class="group">
            <label class="block text-sm font-semibold mb-3" style="color: #ffd700; text-transform: uppercase; letter-spacing: 0.5px;">Quantity <span style="color: #a50000;">*</span></label>
            <input 
                type="number" 
                name="quantity" 
                min="1" 
                required
                placeholder="Enter quantity"
                class="w-full px-5 py-3 border-2 rounded-lg focus:outline-none transition-all duration-300 font-medium"
                style="background-color: #2d1515; border-color: #daa520; color: #ffd700; border-radius: 10px;"
                onfocus="this.style.borderColor='#ffd700'; this.style.boxShadow='0 0 12px rgba(255, 215, 0, 0.3)';" 
                onblur="this.style.borderColor='#daa520'; this.style.boxShadow='none';"
            >
            @error('quantity')
                <p style="color: #a50000;" class="text-xs mt-2 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <!-- Reference -->
        <div class="group">
            <label class="block text-sm font-semibold mb-3" style="color: #ffd700; text-transform: uppercase; letter-spacing: 0.5px;">Reference <span style="color: #a50000;">*</span></label>
            <input 
                type="text" 
                name="reference" 
                required
                placeholder="e.g., PO-2024-001"
                class="w-full px-5 py-3 border-2 rounded-lg focus:outline-none transition-all duration-300 font-medium"
                style="background-color: #2d1515; border-color: #daa520; color: #ffd700; border-radius: 10px;"
                onfocus="this.style.borderColor='#ffd700'; this.style.boxShadow='0 0 12px rgba(255, 215, 0, 0.3)';" 
                onblur="this.style.borderColor='#daa520'; this.style.boxShadow='none';"
            >
            @error('reference')
                <p style="color: #a50000;" class="text-xs mt-2 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <!-- Notes -->
        <div class="group">
            <label class="block text-sm font-semibold mb-3" style="color: #ffd700; text-transform: uppercase; letter-spacing: 0.5px;">Notes <span style="color: #daa520; font-weight: normal; text-transform: none;">(Optional)</span></label>
            <textarea 
                name="notes" 
                rows="3"
                placeholder="Add any additional notes..."
                class="w-full px-5 py-3 border-2 rounded-lg focus:outline-none transition-all duration-300 font-medium resize-none"
                style="background-color: #2d1515; border-color: #daa520; color: #ffd700; border-radius: 10px;"
                onfocus="this.style.borderColor='#ffd700'; this.style.boxShadow='0 0 12px rgba(255, 215, 0, 0.3)';" 
                onblur="this.style.borderColor='#daa520'; this.style.boxShadow='none';"
            ></textarea>
            @error('notes')
                <p style="color: #a50000;" class="text-xs mt-2 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <!-- Info Card -->
        <div class="p-4 rounded-lg" style="background-color: #4a0000; border-left: 4px solid #ffd700; border-radius: 10px;">
            <p class="text-sm font-medium" style="color: #ffd700;">✓ Stock will be added to inventory and recorded in history.</p>
        </div>
    </form>

    @slot('footer')
        <div class="flex gap-3 justify-end p-6" style="background-color: #1a0f0f; border-radius: 0 0 14px 14px;">
            <button 
                type="button"
                @click="open = false"
                class="px-6 py-3 border-2 rounded-lg transition-all duration-300 font-semibold"
                style="color: #daa520; border-color: #daa520; background-color: transparent; border-radius: 10px;"
                onmouseover="this.style.backgroundColor='#8b0000'; this.style.color='white'; this.style.borderColor='#ffd700'; this.style.boxShadow='0 8px 16px rgba(138, 0, 0, 0.3)';" 
                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#daa520'; this.style.borderColor='#daa520'; this.style.boxShadow='none';"
            >
                Cancel
            </button>
            <button 
                type="submit"
                form="stock-in-form"
                class="px-6 py-3 text-white rounded-lg transition-all duration-300 font-semibold"
                style="background-color: #8b0000; border: 2px solid #daa520; border-radius: 10px; box-shadow: 0 4px 12px rgba(138, 0, 0, 0.3);"
                onmouseover="this.style.backgroundColor='#a50000'; this.style.boxShadow='0 8px 20px rgba(138, 0, 0, 0.5)';" 
                onmouseout="this.style.backgroundColor='#8b0000'; this.style.boxShadow='0 4px 12px rgba(138, 0, 0, 0.3)';"
            >
                ✓ Confirm Stock In
            </button>
        </div>
    @endslot
</x-modal>