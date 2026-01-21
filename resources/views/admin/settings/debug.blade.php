<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Settings Debug</h1>

        @php
            $logoSetting = \App\Models\Setting::where('key', 'site_logo')->first();
            $faviconSetting = \App\Models\Setting::where('key', 'site_favicon')->first();
        @endphp

        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h2 class="text-xl font-semibold mb-4">Logo Setting</h2>
            <p class="mb-2"><strong>Database Value:</strong> {{ $logoSetting->value ?? 'Not set' }}</p>
            @if($logoSetting && $logoSetting->value)
                @php
                    $logoUrl = \Storage::disk('supabase')->url($logoSetting->value);
                @endphp
                <p class="mb-2"><strong>Full URL:</strong> {{ $logoUrl }}</p>
                <p class="mb-4"><strong>Preview:</strong></p>
                <img src="{{ $logoUrl }}" alt="Logo" class="w-32 h-32 object-contain border">
            @else
                <p class="text-red-500">Logo not uploaded yet</p>
            @endif
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Favicon Setting</h2>
            <p class="mb-2"><strong>Database Value:</strong> {{ $faviconSetting->value ?? 'Not set' }}</p>
            @if($faviconSetting && $faviconSetting->value)
                @php
                    $faviconUrl = \Storage::disk('supabase')->url($faviconSetting->value);
                @endphp
                <p class="mb-2"><strong>Full URL:</strong> {{ $faviconUrl }}</p>
                <p class="mb-4"><strong>Preview:</strong></p>
                <img src="{{ $faviconUrl }}" alt="Favicon" class="w-16 h-16 object-contain border">
            @else
                <p class="text-red-500">Favicon not uploaded yet</p>
            @endif
        </div>
    </div>
</x-app-layout>