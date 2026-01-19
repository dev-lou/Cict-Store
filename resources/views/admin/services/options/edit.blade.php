<x-admin-layout>
    @section('page-title', 'Edit Service Option')

    <style>
        :root {
            --bg-main: #0f172a;
            --bg-card: #1e293b;
            --border: #334155;
            --primary: #3b82f6;
            --danger: #ef4444;
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
        }

        .form-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 24px;
            max-width: 1000px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .label {
            display: block;
            color: var(--text-primary);
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .input {
            width: 100%;
            background: var(--bg-main);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 10px 14px;
            color: var(--text-primary);
            font-size: 14px;
            transition: all 0.2s;
        }

        .input:focus {
            outline: none;
            border-color: var(--primary);
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            padding: 10px 24px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-secondary {
            background: transparent;
            color: var(--text-secondary);
            padding: 10px 24px;
            border-radius: 8px;
            border: 1px solid var(--border);
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
        }

        .btn-secondary:hover {
            color: var(--text-primary);
            border-color: var(--text-secondary);
        }

        .helper-text {
            color: var(--text-secondary);
            font-size: 12px;
            margin-top: 4px;
        }

        .error-text {
            color: var(--danger);
            font-size: 12px;
            margin-top: 4px;
        }
    </style>

    <div class="p-6" style="background: var(--bg-main); min-height: calc(100vh - 4rem);">
        <div class="mb-6">
            <h1 class="text-3xl font-bold" style="color: var(--text-primary);">Edit Option: {{ $option->name }}</h1>
            <p class="text-sm mt-1" style="color: var(--text-secondary);">Update option details</p>
        </div>

        <div class="form-card">
            <form action="{{ route('admin.services.options.update', $option) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="form-grid">
                    <div>
                        <label class="label" for="name">Option Name *</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            class="input @error('name') border-red-500 @enderror" 
                            value="{{ old('name', $option->name) }}"
                            required
                            placeholder="e.g., A4, Letter, Legal"
                        >
                        @error('name')
                            <p class="error-text">{{ $message }}</p>
                        @else
                            <p class="helper-text">Name of the option</p>
                        @enderror
                    </div>

                    <div>
                        <label class="label" for="dimensions">Dimensions</label>
                        <input 
                            type="text" 
                            name="dimensions" 
                            id="dimensions" 
                            class="input @error('dimensions') border-red-500 @enderror" 
                            value="{{ old('dimensions', $option->dimensions) }}"
                            placeholder="e.g., 8.5×11 in"
                        >
                        @error('dimensions')
                            <p class="error-text">{{ $message }}</p>
                        @else
                            <p class="helper-text">Size or specs</p>
                        @enderror
                    </div>

                    <div>
                        <label class="label" for="price_bw">Primary Price (₱)</label>
                        <input 
                            type="number" 
                            name="price_bw" 
                            id="price_bw" 
                            class="input @error('price_bw') border-red-500 @enderror" 
                            value="{{ old('price_bw', $option->price_bw) }}"
                            step="0.01"
                            min="0"
                            placeholder="e.g., 5.00"
                        >
                        @error('price_bw')
                            <p class="error-text">{{ $message }}</p>
                        @else
                            <p class="helper-text">Primary price</p>
                        @enderror
                    </div>

                    <div>
                        <label class="label" for="price_bw_label">Primary Price Label</label>
                        <input 
                            type="text" 
                            name="price_bw_label" 
                            id="price_bw_label" 
                            class="input @error('price_bw_label') border-red-500 @enderror" 
                            value="{{ old('price_bw_label', $option->price_bw_label) }}"
                            placeholder="e.g., per page"
                        >
                        @error('price_bw_label')
                            <p class="error-text">{{ $message }}</p>
                        @else
                            <p class="helper-text">Optional unit label</p>
                        @enderror
                    </div>

                    <div>
                        <label class="label" for="price_color">Secondary Price (₱)</label>
                        <input 
                            type="number" 
                            name="price_color" 
                            id="price_color" 
                            class="input @error('price_color') border-red-500 @enderror" 
                            value="{{ old('price_color', $option->price_color) }}"
                            step="0.01"
                            min="0"
                            placeholder="e.g., 15.00"
                        >
                        @error('price_color')
                            <p class="error-text">{{ $message }}</p>
                        @else
                            <p class="helper-text">Secondary price</p>
                        @enderror
                    </div>

                    <div>
                        <label class="label" for="price_color_label">Secondary Price Label</label>
                        <input 
                            type="text" 
                            name="price_color_label" 
                            id="price_color_label" 
                            class="input @error('price_color_label') border-red-500 @enderror" 
                            value="{{ old('price_color_label', $option->price_color_label) }}"
                            placeholder="e.g., per page"
                        >
                        @error('price_color_label')
                            <p class="error-text">{{ $message }}</p>
                        @else
                            <p class="helper-text">Optional unit label</p>
                        @enderror
                    </div>

                    <div>
                        <label class="label" for="badge">Badge</label>
                        <input 
                            type="text" 
                            name="badge" 
                            id="badge" 
                            class="input @error('badge') border-red-500 @enderror" 
                            value="{{ old('badge', $option->badge) }}"
                            placeholder="e.g., Popular, Recommended"
                        >
                        @error('badge')
                            <p class="error-text">{{ $message }}</p>
                        @else
                            <p class="helper-text">Optional badge text</p>
                        @enderror
                    </div>

                    <div>
                        <label class="label" for="size_class">Display Size</label>
                        <select 
                            name="size_class" 
                            id="size_class" 
                            class="input @error('size_class') border-red-500 @enderror"
                            required
                        >
                            <option value="short" {{ old('size_class', $option->size_class) === 'short' ? 'selected' : '' }}>Compact</option>
                            <option value="standard" {{ old('size_class', $option->size_class) === 'standard' ? 'selected' : '' }}>Standard</option>
                            <option value="long" {{ old('size_class', $option->size_class) === 'long' ? 'selected' : '' }}>Large</option>
                        </select>
                        @error('size_class')
                            <p class="error-text">{{ $message }}</p>
                        @else
                            <p class="helper-text">Card display size</p>
                        @enderror
                    </div>

                    <div class="full-width" style="margin-bottom: 20px;">
                        <label class="flex items-center gap-2" style="cursor: pointer;">
                            <input 
                                type="checkbox" 
                                name="is_active" 
                                value="1" 
                                {{ old('is_active', $option->is_active) ? 'checked' : '' }}
                                style="width: 16px; height: 16px;"
                            >
                            <span style="color: var(--text-secondary); font-size: 14px;">Active (visible to students)</span>
                        </label>
                    </div>
                </div>

                <div class="flex gap-3" style="margin-top: 20px;">
                    <button type="submit" class="btn-primary">
                        Update Option
                    </button>
                    <a href="{{ route('admin.services.options.index', $option->service) }}" class="btn-secondary">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#ef4444'
            });
        @endif
    </script>
</x-admin-layout>
