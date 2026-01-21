<x-admin-layout>
    @section('page-title', 'User Management')

    <!-- Breadcrumb -->
    <x-admin.breadcrumb :items="[
        ['label' => 'System'],
        ['label' => 'Users']
    ]" />

    <!-- Header Section -->
    <x-admin.page-header title="User Management" subtitle="Manage all system users and their access">
        <x-slot:actions>
            <x-admin.button href="{{ route('admin.users.create') }}" variant="primary" size="lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add User
            </x-admin.button>
        </x-slot:actions>
    </x-admin.page-header>

    <!-- Search Section -->
    <x-admin.filter-bar action="{{ route('admin.users.index') }}">
        <div class="flex-1 min-w-64">
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Search by name or email..." 
                   class="w-full px-4 py-2.5 rounded-xl text-white focus:outline-none transition-all"
                   style="border: 1px solid rgba(255, 255, 255, 0.1); background: rgba(15, 20, 25, 0.6);" 
                   onfocus="this.style.borderColor='#3b82f6'; this.style.background='rgba(15, 20, 25, 0.8)'" 
                   onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.background='rgba(15, 20, 25, 0.6)'" />
        </div>
        
        <select name="role" class="px-4 py-2.5 rounded-xl text-white focus:outline-none transition-all min-w-[150px]"
                style="border: 1px solid rgba(255, 255, 255, 0.1); background: rgba(15, 20, 25, 0.6);" 
                onfocus="this.style.borderColor='#3b82f6'; this.style.background='rgba(15, 20, 25, 0.8)'" 
                onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.background='rgba(15, 20, 25, 0.6)'">
            <option value="">All Roles</option>
            @foreach(['admin', 'staff', 'customer'] as $roleOption)
                <option value="{{ $roleOption }}" {{ request('role') === $roleOption ? 'selected' : '' }}>
                    {{ ucfirst($roleOption) }}
                </option>
            @endforeach
        </select>
        
        <x-admin.button type="submit" variant="primary">
            Filter
        </x-admin.button>
        
        @if(request('search') || request('role'))
            <x-admin.button href="{{ route('admin.users.index') }}" variant="secondary">
                Clear
            </x-admin.button>
        @endif
    </x-admin.filter-bar>
    @if(session('error'))
        <div class="mb-6 p-4 rounded-lg" style="background-color: #f44336; color: white; border: 2px solid #da190b;">
            {{ session('error') }}
        </div>
    @endif

    <!-- Users Table -->
    <div class="rounded-xl shadow-lg overflow-hidden" 
         style="background: linear-gradient(135deg, rgba(15, 20, 25, 0.8) 0%, rgba(26, 31, 46, 0.8) 100%); 
                border: 1px solid rgba(255, 255, 255, 0.1);">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border-bottom: 2px solid rgba(255, 255, 255, 0.1);">
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">Name</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">Email</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">Roles</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">Created</th>
                        <th class="px-6 py-4 text-center text-sm font-bold text-white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="transition-all duration-200" 
                            style="border-bottom: 1px solid rgba(255, 255, 255, 0.05);" 
                            onmouseover="this.style.background='rgba(59, 130, 246, 0.1)'" 
                            onmouseout="this.style.background='transparent'">
                            <td class="px-6 py-4 text-white font-semibold">
                                {{ $user->name }}
                                @if($user->id === auth()->id())
                                    <span class="px-2 py-1 rounded-lg text-xs font-bold ml-2" 
                                          style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white;">(You)</span>
                                @endif
                            </td>
                            <td class="px-6 py-4" style="color: rgba(255, 255, 255, 0.6);">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2 flex-wrap">
                                    @php
                                        $roles = $user->roles;
                                        if (is_string($roles)) {
                                            $roles = json_decode($roles, true) ?? [];
                                        }
                                        if (!is_array($roles)) {
                                            $roles = [];
                                        }
                                    @endphp
                                    @forelse($roles as $role)
                                        <span class="px-3 py-1.5 rounded-lg text-xs font-bold inline-block" 
                                              style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white;">
                                            {{ ucfirst($role) }}
                                        </span>
                                    @empty
                                        <span style="color: rgba(255, 255, 255, 0.4);">No roles</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="px-6 py-4" style="color: rgba(255, 255, 255, 0.6);">{{ $user->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex gap-2 justify-center">
                                    <x-admin.button 
                                        href="{{ route('admin.users.edit', $user) }}" 
                                        size="sm" 
                                        variant="primary">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </x-admin.button>
                                    @if($user->id !== auth()->id())
                                        <x-admin.button 
                                            type="button" 
                                            onclick="deleteUser({{ $user->id }})" 
                                            size="sm" 
                                            variant="danger">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Delete
                                        </x-admin.button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <svg class="w-16 h-16 mx-auto mb-4 opacity-30" style="color: rgba(255, 255, 255, 0.3);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <p class="text-lg font-semibold" style="color: rgba(255, 255, 255, 0.6);">No users found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($users && is_object($users) && method_exists($users, 'hasPages') && $users->hasPages())
        <div class="mt-8 flex justify-center">
            {{ $users->links('pagination::tailwind') }}
        </div>
    @endif
</x-admin-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
<script>
    function deleteUser(userId) {
        Swal.fire({
            title: 'Delete User?',
            text: 'This action cannot be undone. The user will be permanently deleted.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f44336',
            cancelButtonColor: '#666',
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: 'Cancel',
            background: '#0f1419',
            color: '#ffffff',
            titleColor: '#ffffff',
            iconColor: '#ff9500',
            didOpen: () => {
                document.querySelector('.swal2-popup').style.border = '3px solid #b0bcc4';
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Create form and submit delete request
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/users/${userId}`;
                form.innerHTML = `
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                `;
                document.body.appendChild(form);
                
                // Show loading state
                Swal.fire({
                    title: 'Deleting...',
                    text: 'Please wait while the user is being deleted.',
                    icon: 'info',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                        document.querySelector('.swal2-popup').style.border = '3px solid #b0bcc4';
                    },
                    background: '#0f1419',
                    color: '#ffffff',
                    titleColor: '#ffffff',
                    iconColor: '#b0bcc4'
                });
                
                form.submit();
            }
        });
    }

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false,
            background: '#0f1419',
            color: '#ffffff',
            iconColor: '#4caf50',
            didOpen: () => {
                document.querySelector('.swal2-popup').style.border = '3px solid #b0bcc4';
            }
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
            confirmButtonColor: '#ef4444',
            background: '#0f1419',
            color: '#ffffff',
            iconColor: '#ef4444',
            didOpen: () => {
                document.querySelector('.swal2-popup').style.border = '3px solid #b0bcc4';
            }
        });
    @endif
</script>
