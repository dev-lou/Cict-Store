<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'CICT Dingle') }}</title>
    
    @php
        $faviconSetting = \App\Models\Setting::where('key', 'site_favicon')->first();
        $faviconUrl = $faviconSetting && $faviconSetting->value 
            ? \Storage::disk('supabase')->url($faviconSetting->value) 
            : asset('images/ctrlp-logo.png');
    @endphp
    
    <link rel="icon" type="image/png" sizes="32x32" href="{{ $faviconUrl }}">
    <link rel="shortcut icon" href="{{ $faviconUrl }}">
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900" rel="stylesheet" />
    @include('components.vite-assets')
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-white antialiased">
    <!-- Page Content (No navbar/header) -->
    <main>
        {{ $slot }}
    </main>
</body>
</html>
