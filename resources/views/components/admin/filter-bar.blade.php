@props(['action' => '', 'method' => 'GET'])

<div class="rounded-xl shadow-lg p-6 mb-6" 
     style="background: linear-gradient(135deg, rgba(15, 20, 25, 0.8) 0%, rgba(26, 31, 46, 0.8) 100%); 
            border: 1px solid rgba(255, 255, 255, 0.1);">
    <form method="{{ $method }}" action="{{ $action }}" class="flex gap-4 flex-wrap items-end">
        @if($method !== 'GET')
            @csrf
            @method($method)
        @endif
        {{ $slot }}
    </form>
</div>
