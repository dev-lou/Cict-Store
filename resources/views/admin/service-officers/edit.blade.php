<x-admin-layout>
    @section('page-title', 'Edit Service Officer')

    <!-- Breadcrumb -->
    <x-admin.breadcrumb :items="[
        ['label' => 'Catalog'],
        ['label' => 'Service Officers', 'url' => route('admin.service-officers.index')],
        ['label' => 'Edit Officer']
    ]" />

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
            max-width: 600px;
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
            <h1 class="text-3xl font-bold" style="color: var(--text-primary);">Edit Service Officer</h1>
            <p class="text-sm mt-1" style="color: var(--text-secondary);">Update officer information</p>
        </div>

        <div class="form-card">
            <form action="{{ route('admin.service-officers.update', $officer) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label class="label" for="name">Name *</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        class="input @error('name') border-red-500 @enderror" 
                        value="{{ old('name', $officer->name) }}"
                        required
                        placeholder="e.g., John Dela Cruz"
                    >
                    @error('name')
                        <p class="error-text">{{ $message }}</p>
                    @else
                        <p class="helper-text">Full name of the service officer</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="label" for="title">Title</label>
                    <input 
                        type="text" 
                        name="title" 
                        id="title" 
                        class="input @error('title') border-red-500 @enderror" 
                        value="{{ old('title', $officer->title) }}"
                        placeholder="e.g., OFFICER, PRESIDENT, SECRETARY"
                    >
                    @error('title')
                        <p class="error-text">{{ $message }}</p>
                    @else
                        <p class="helper-text">Position or role (optional)</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="label" for="messenger_url">Messenger URL</label>
                    <input 
                        type="url" 
                        name="messenger_url" 
                        id="messenger_url" 
                        class="input @error('messenger_url') border-red-500 @enderror" 
                        value="{{ old('messenger_url', $officer->messenger_url) }}"
                        placeholder="https://m.me/username"
                    >
                    @error('messenger_url')
                        <p class="error-text">{{ $message }}</p>
                    @else
                        <p class="helper-text">Facebook Messenger contact link (optional)</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="flex items-center gap-2" style="cursor: pointer;">
                        <input 
                            type="checkbox" 
                            name="is_active" 
                            value="1" 
                            {{ old('is_active', $officer->is_active) ? 'checked' : '' }}
                            style="width: 16px; height: 16px;"
                        >
                        <span style="color: var(--text-secondary); font-size: 14px;">Active (visible to students)</span>
                    </label>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="btn-primary">
                        Update Officer
                    </button>
                    <a href="{{ route('admin.service-officers.index') }}" class="btn-secondary">
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
