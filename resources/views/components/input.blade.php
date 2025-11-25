@props([
    'label' => '',
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'value' => '',
    'error' => null,
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'class' => '',
])

<div class="flex flex-col gap-2">
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
            {{ $label }}
            @if ($required)
                <span class="text-red-500 ml-1">*</span>
            @endif
        </label>
    @endif

    @if ($type === 'textarea')
        <textarea
            id="{{ $name }}"
            name="{{ $name }}"
            {{ $disabled ? 'disabled' : '' }}
            {{ $readonly ? 'readonly' : '' }}
            {{ $required ? 'required' : '' }}
            placeholder="{{ $placeholder }}"
            class="w-full px-4 py-2.5 text-base rounded-lg border-2 border-gray-200 bg-white text-gray-900 placeholder-gray-400 transition-all duration-200 ease-out focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-offset-0 {{ $error ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : '' }} {{ $disabled ? 'opacity-50 cursor-not-allowed bg-gray-100' : '' }} {{ $class }}"
            rows="4"
        >{{ $value }}</textarea>
    @elseif ($type === 'select')
        <select
            id="{{ $name }}"
            name="{{ $name }}"
            {{ $disabled ? 'disabled' : '' }}
            {{ $required ? 'required' : '' }}
            class="w-full px-4 py-2.5 text-base rounded-lg border-2 border-gray-200 bg-white text-gray-900 transition-all duration-200 ease-out focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-offset-0 appearance-none {{ $error ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : '' }} {{ $disabled ? 'opacity-50 cursor-not-allowed bg-gray-100' : '' }} {{ $class }}"
        >
            {{ $slot }}
        </select>
    @else
        <input
            type="{{ $type }}"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ old($name, $value) }}"
            {{ $disabled ? 'disabled' : '' }}
            {{ $readonly ? 'readonly' : '' }}
            {{ $required ? 'required' : '' }}
            placeholder="{{ $placeholder }}"
            class="w-full px-4 py-2.5 text-base rounded-lg border-2 border-gray-200 bg-white text-gray-900 placeholder-gray-400 transition-all duration-200 ease-out focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-offset-0 {{ $error ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : '' }} {{ $disabled ? 'opacity-50 cursor-not-allowed bg-gray-100' : '' }} {{ $readonly ? 'bg-gray-100 cursor-not-allowed' : '' }} {{ $class }}"
        />
    @endif

    @if ($error)
        <p class="text-sm font-medium text-red-600">{{ $error }}</p>
    @endif

    {{ $help ?? '' }}
</div>
