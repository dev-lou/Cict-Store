<x-admin-layout>
    @section('page-title', 'Edit Service')

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

        textarea.input {
            resize: vertical;
            min-height: 80px;
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

        .icon-grid {
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            gap: 8px;
            margin-bottom: 8px;
        }

        .icon-pick {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            cursor: pointer;
            border: 2px solid var(--border);
            border-radius: 8px;
            transition: all 0.2s;
        }

        .icon-pick:hover {
            border-color: var(--primary);
            transform: scale(1.1);
        }

        .icon-pick.selected {
            border-color: var(--primary);
            background: rgba(59, 130, 246, 0.2);
        }
    </style>

    <div class="p-6" style="background: var(--bg-main); min-height: calc(100vh - 4rem);">
        <div class="mb-6">
            <h1 class="text-3xl font-bold" style="color: var(--text-primary);">Edit Service</h1>
            <p class="text-sm mt-1" style="color: var(--text-secondary);">Update service information</p>
        </div>

        <div class="form-card">
            <form action="{{ route('admin.services.update', $service) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="form-grid">
                    <div class="full-width">
                        <label class="label">Icon *</label>
                        <input type="hidden" name="icon" id="selectedIcon" value="{{ old('icon', $service->icon) }}">
                        <div class="icon-grid">
                            @foreach(['🖨️','🎨','📄','📦','🧾','✂️','🖼️','📐','💡','⚙️','🧵','🛠️','🎁','📊','🧮','🪄'] as $emoji)
                                <div class="icon-pick {{ old('icon', $service->icon) === $emoji ? 'selected' : '' }}" data-icon="{{ $emoji }}" onclick="selectIcon('{{ $emoji }}')">{{ $emoji }}</div>
                            @endforeach
                        </div>
                        @error('icon')
                            <p class="error-text">{{ $message }}</p>
                        @else
                            <p class="helper-text">Choose an emoji icon for the service</p>
                        @enderror
                    </div>

                    <div>
                        <label class="label" for="title">Title *</label>
                        <input 
                            type="text" 
                            name="title" 
                            id="title" 
                            class="input @error('title') border-red-500 @enderror" 
                            value="{{ old('title', $service->title) }}"
                            required
                            placeholder="e.g., Color Printing"
                        >
                        @error('title')
                            <p class="error-text">{{ $message }}</p>
                        @else
                            <p class="helper-text">Short and descriptive</p>
                        @enderror
                    </div>

                    <div>
                        <label class="label" for="price_bw">Price (₱)</label>
                        <input 
                            type="number" 
                            name="price_bw" 
                            id="price_bw" 
                            class="input @error('price_bw') border-red-500 @enderror" 
                            value="{{ old('price_bw', $service->price_bw) }}"
                            step="0.01"
                            min="0"
                            placeholder="e.g., 50.00"
                        >
                        @error('price_bw')
                            <p class="error-text">{{ $message }}</p>
                        @else
                            <p class="helper-text">Optional</p>
                        @enderror
                    </div>

                    <div>
                        <label class="label" for="price_bw_label">Price Label</label>
                        <input 
                            type="text" 
                            name="price_bw_label" 
                            id="price_bw_label" 
                            class="input @error('price_bw_label') border-red-500 @enderror" 
                            value="{{ old('price_bw_label', $service->price_bw_label) }}"
                            placeholder="e.g., per page, per hour, per item"
                        >
                        @error('price_bw_label')
                            <p class="error-text">{{ $message }}</p>
                        @else
                            <p class="helper-text">Optional price note</p>
                        @enderror
                    </div>

                    <div class="full-width">
                        <label class="label" for="description">Description *</label>
                        <textarea 
                            name="description" 
                            id="description" 
                            class="input @error('description') border-red-500 @enderror" 
                            required
                            placeholder="e.g., Vibrant full-color prints for presentations and projects."
                            style="min-height: 60px;"
                        >{{ old('description', $service->description) }}</textarea>
                        @error('description')
                            <p class="error-text">{{ $message }}</p>
                        @else
                            <p class="helper-text">One or two sentences</p>
                        @enderror
                    </div>

                    <div>
                        <label class="label" for="category_select">Category</label>
                        <select 
                            id="category_select" 
                            class="input @error('category') border-red-500 @enderror"
                            onchange="handleCategorySelect(this.value)"
                        >
                            <option value="">-- Select or create new --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ old('category', $service->category) === $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                            <option value="__new__">+ Create New Category</option>
                        </select>
                        <input 
                            type="text" 
                            name="category" 
                            id="category" 
                            class="input mt-2 @error('category') border-red-500 @enderror" 
                            value="{{ old('category', $service->category) }}"
                            placeholder="Enter category name"
                            style="display: none;"
                        >
                        @error('category')
                            <p class="error-text">{{ $message }}</p>
                        @else
                            <p class="helper-text">Group services</p>
                        @enderror
                    </div>

                    <div class="full-width" style="margin-bottom: 20px;">
                        <label class="flex items-center gap-2" style="cursor: pointer;">
                            <input 
                                type="checkbox" 
                                name="is_active" 
                                value="1" 
                                {{ old('is_active', $service->is_active) ? 'checked' : '' }}
                                style="width: 16px; height: 16px;"
                            >
                            <span style="color: var(--text-secondary); font-size: 14px;">Active (visible to students)</span>
                        </label>
                    </div>
                </div>

                <div class="flex gap-3" style="margin-top: 20px;">
                    <button type="submit" class="btn-primary">
                        Update Service
                    </button>
                    <a href="{{ route('admin.services.index') }}" class="btn-secondary">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function selectIcon(icon) {
            document.getElementById('selectedIcon').value = icon;
            document.querySelectorAll('.icon-pick').forEach(el => el.classList.remove('selected'));
            document.querySelector(`.icon-pick[data-icon="${icon}"]`).classList.add('selected');
        }

        function handleCategorySelect(value) {
            const categoryInput = document.getElementById('category');
            
            if (value === '__new__') {
                // Show custom input for new category
                categoryInput.style.display = 'block';
                categoryInput.value = '';
                categoryInput.focus();
            } else if (value) {
                // Use selected existing category
                categoryInput.style.display = 'none';
                categoryInput.value = value;
            } else {
                // No selection
                categoryInput.style.display = 'none';
                categoryInput.value = 'General';
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById('category_select');
            if (select.value) {
                handleCategorySelect(select.value);
            }
        });

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
