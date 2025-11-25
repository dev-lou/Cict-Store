<x-admin-layout>
    @section('page-title', 'User Management')

    <!-- Header Section -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold mb-2" style="color: #ffffff; letter-spacing: 0.5px;">User Management</h2>
            <p class="text-sm" style="color: #b0bcc4;">Manage all system users and their access</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-lg font-bold" style="background-color: #0f6fdd; border: 2px solid #b0bcc4; border-radius: 12px; color: #ffffff; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#1a7fff'; this.style.boxShadow='0 8px 20px rgba(138, 0, 0, 0.5)';" onmouseout="this.style.backgroundColor='#0f6fdd'; this.style.boxShadow='';">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add User
        </a>
    </div>

    <!-- Search Section -->
    <div class="rounded-xl shadow-lg p-6 mb-6" style="background: linear-gradient(135deg, #1a1f2e 0%, #0f1419 100%); border: 2px solid #b0bcc4; border-radius: 16px;">
        <form method="GET" action="{{ route('admin.users.index') }}" class="flex gap-3 flex-wrap">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or email..." class="flex-1 rounded-lg px-4 py-2 min-w-[200px]" style="border: 2px solid #b0bcc4; background-color: #0f1419; color: #b0bcc4;" />
            
            <select name="role" class="px-4 py-2 rounded-lg font-semibold" style="border: 2px solid #b0bcc4; background-color: #0f1419; color: #b0bcc4; min-width: 120px;">
                <option value="">All Roles</option>
                @foreach(['admin', 'staff', 'customer'] as $roleOption)
                    <option value="{{ $roleOption }}" {{ request('role') === $roleOption ? 'selected' : '' }}>
                        {{ ucfirst($roleOption) }}
                    </option>
                @endforeach
            </select>
            
            <button type="submit" class="px-6 py-2 rounded-lg font-bold" style="background-color: #0f6fdd; color: #ffffff; border: 2px solid #b0bcc4;" onmouseover="this.style.backgroundColor='#1a7fff'" onmouseout="this.style.backgroundColor='#0f6fdd'">
                Filter
            </button>
            @if(request('search') || request('role'))
                <a href="{{ route('admin.users.index') }}" class="px-6 py-2 rounded-lg font-bold" style="background-color: #666; color: white; border: 2px solid #888;">
                    Clear
                </a>
            @endif
        </form>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 p-4 rounded-lg" style="background-color: #4caf50; color: white; border: 2px solid #45a049;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
        <div class="mb-6 p-4 rounded-lg" style="background-color: #f44336; color: white; border: 2px solid #da190b;">
            {{ session('error') }}
        </div>
    @endif

    <!-- Users Table -->
    <div class="rounded-xl shadow-lg overflow-hidden" style="background-color: #1a1f2e; border: 2px solid #b0bcc4; border-radius: 16px;">
        <table class="w-full">
            <thead>
                <tr style="background-color: #0f6fdd; border-bottom: 2px solid #b0bcc4;">
                    <th class="px-6 py-4 text-left font-bold" style="color: #ffffff;">Name</th>
                    <th class="px-6 py-4 text-left font-bold" style="color: #ffffff;">Email</th>
                    <th class="px-6 py-4 text-left font-bold" style="color: #ffffff;">Roles</th>
                    <th class="px-6 py-4 text-left font-bold" style="color: #ffffff;">Created</th>
                    <th class="px-6 py-4 text-center font-bold" style="color: #ffffff;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="transition-colors" style="border-bottom: 2px solid #b0bcc4;" onmouseover="this.style.backgroundColor='#0f6fdd'" onmouseout="this.style.backgroundColor='transparent'">
                        <td class="px-6 py-4" style="color: #ffffff; font-weight: bold;">
                            {{ $user->name }}
                            @if($user->id === auth()->id())
                                <span class="px-2 py-1 rounded text-xs font-bold ml-2" style="background-color: #b0bcc4; color: #0f1419;">(You)</span>
                            @endif
                        </td>
                        <td class="px-6 py-4" style="color: #b0bcc4;">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <div style="display: flex; gap: 4px; flex-wrap: wrap;">
                                @php
                                    $roles = $user->roles;
                                    // Handle case where roles might be a string instead of array
                                    if (is_string($roles)) {
                                        $roles = json_decode($roles, true) ?? [];
                                    }
                                    if (!is_array($roles)) {
                                        $roles = [];
                                    }
                                @endphp
                                @forelse($roles as $role)
                                    <span class="px-3 py-1 rounded-full text-xs font-bold" style="background-color: #0f6fdd; color: #ffffff; border: 1px solid #b0bcc4;">
                                        {{ ucfirst($role) }}
                                    </span>
                                @empty
                                    <span style="color: #999;">No roles</span>
                                @endforelse
                            </div>
                        </td>
                        <td class="px-6 py-4" style="color: #b0bcc4;">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 text-center">
                            <div style="display: flex; gap: 6px; justify-content: center;">
                                <!-- Edit Button -->
                                <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md text-xs font-semibold transition-all" style="background-color: #0f6fdd; color: #ffffff; border: 1px solid #b0bcc4;" onmouseover="this.style.backgroundColor='#1a7fff'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.2)'" onmouseout="this.style.backgroundColor='#0f6fdd'; this.style.boxShadow=''">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    Edit
                                </a>
                                <!-- Delete Button -->
                                @if($user->id !== auth()->id())
                                    <button type="button" onclick="deleteUser({{ $user->id }})" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md text-xs font-semibold transition-all" style="background-color: #f44336; color: white; border: 1px solid #f44336; cursor: pointer;" onmouseover="this.style.backgroundColor='#ff6b6b'; this.style.boxShadow='0 2px 4px rgba(244,67,54,0.3)'" onmouseout="this.style.backgroundColor='#f44336'; this.style.boxShadow=''">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        Delete
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center" style="color: #b0bcc4;">
                            No users found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
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
</script>
