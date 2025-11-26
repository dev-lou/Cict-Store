@php
    $viteManifest = public_path('build/manifest.json');
    $legacyViteManifest = public_path('build/.vite/manifest.json');
@endphp

@if (file_exists($viteManifest) || file_exists($legacyViteManifest))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@else
    <!-- Vite manifest not found; fallback to static assets -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
@endif
