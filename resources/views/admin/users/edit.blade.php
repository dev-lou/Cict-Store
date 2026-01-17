<x-admin-layout>
    @section('page-title', 'Edit User')

    <x-admin.breadcrumb :items="[
        ['label' => 'System'],
        ['label' => 'Users', 'url' => route('admin.users.index')],
        ['label' => 'Edit User']
    ]" />

    <x-admin.page-header title="Edit User Profile" subtitle="Manage user information and permissions" />

    <div class="px-8">
        <div class="rounded-2xl shadow-2xl overflow-hidden" style="background: linear-gradient(180deg, #1a1f2e 0%, #0f1419 100%); border: 2px solid #b0bcc4;">
            <div style="height: 3px; background: linear-gradient(90deg, #0f6fdd 0%, #b0bcc4 50%, #0f6fdd 100%);"></div>
            
            <div class="p-6">
                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <!-- Compact Profile Bento Card -->
                    <div class="mb-6 p-4 rounded-xl flex items-center gap-6" style="background: rgba(15, 111, 221, 0.05); border: 1px solid rgba(15, 111, 221, 0.2);">
                        <div class="flex-shrink-0">
                            @if($user->profile_picture)
                                <img id="profile-preview" src="{{ asset('storage/' . $user->profile_picture) }}?t={{ time() }}" alt="Profile" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid #0f6fdd; box-shadow: 0 4px 12px rgba(15, 111, 221, 0.3);">
                            @else
                                <div id="profile-preview" style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 32px; font-weight: bold; border: 3px solid #0f6fdd; box-shadow: 0 4px 12px rgba(15, 111, 221, 0.3);">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div class="flex-grow">
                            <h4 class="font-bold text-lg mb-1" style="color: #ffffff;">{{ $user->name }}</h4>
                            <p class="text-sm" style="color: #b0bcc4;">{{ $user->email }}</p>
                            <p class="text-xs mt-1" style="color: #999;">User ID: <span class="font-bold" style="color: #b0bcc4;">#{{ $user->id }}</span></p>
                        </div>
                        <div class="flex-shrink-0">
                            <button type="button" onclick="document.getElementById('admin-profile-picture-input').click();" class="px-6 py-3 rounded-lg font-semibold text-sm transition-all whitespace-nowrap" style="background: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%); color: white; border: 2px solid #0f6fdd;" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 12px rgba(15, 111, 221, 0.4)'" onmouseout="this.style.transform=''; this.style.boxShadow=''">
                                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Change Photo
                            </button>
                            <input type="file" id="admin-profile-picture-input" accept="image/*" style="display: none;" onchange="handleAdminProfilePictureUpload(this, {{ $user->id }})">
                        </div>
                    </div>

                    <!-- Form Fields -->
                    <div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-sm font-semibold mb-2" style="color: #b0bcc4;">
                                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        Full Name <span style="color: #f44336;">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        id="name" 
                                        name="name" 
                                        value="{{ old('name', $user->name) }}"
                                        class="w-full px-4 py-2.5 rounded-lg text-base transition-all"
                                        style="border: 2px solid #444; background-color: #0f0707; color: #ffffff;"
                                        onfocus="this.style.borderColor='#0f6fdd'; this.style.boxShadow='0 0 0 3px rgba(15, 111, 221, 0.1)'"
                                        onblur="this.style.borderColor='#444'; this.style.boxShadow=''"
                                        required
                                    />
                                    @error('name')
                                        <p class="mt-1.5 text-sm" style="color: #ff6b6b;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-semibold mb-2" style="color: #b0bcc4;">
                                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        Email <span style="color: #f44336;">*</span>
                                    </label>
                                    <input 
                                        type="email" 
                                        id="email" 
                                        name="email" 
                                        value="{{ old('email', $user->email) }}"
                                        class="w-full px-4 py-2.5 rounded-lg text-base transition-all"
                                        style="border: 2px solid #444; background-color: #0f0707; color: #ffffff;"
                                        onfocus="this.style.borderColor='#0f6fdd'; this.style.boxShadow='0 0 0 3px rgba(15, 111, 221, 0.1)'"
                                        onblur="this.style.borderColor='#444'; this.style.boxShadow=''"
                                        required
                                    />
                                    @error('email')
                                        <p class="mt-1.5 text-sm" style="color: #ff6b6b;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div>
                                    <label for="password" class="block text-sm font-semibold mb-2" style="color: #b0bcc4;">
                                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                        New Password <span class="text-xs font-normal" style="color: #999;">(optional)</span>
                                    </label>
                                    <input 
                                        type="password" 
                                        id="password" 
                                        name="password" 
                                        placeholder="••••••••"
                                        class="w-full px-4 py-2.5 rounded-lg text-base transition-all"
                                        style="border: 2px solid #444; background-color: #0f0707; color: #ffffff;"
                                        onfocus="this.style.borderColor='#0f6fdd'; this.style.boxShadow='0 0 0 3px rgba(15, 111, 221, 0.1)'"
                                        onblur="this.style.borderColor='#444'; this.style.boxShadow=''"
                                    />
                                    @error('password')
                                        <p class="mt-1.5 text-sm" style="color: #ff6b6b;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-semibold mb-2" style="color: #b0bcc4;">
                                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Confirm Password
                                    </label>
                                    <input 
                                        type="password" 
                                        id="password_confirmation" 
                                        name="password_confirmation" 
                                        placeholder="••••••••"
                                        class="w-full px-4 py-2.5 rounded-lg text-base transition-all"
                                        style="border: 2px solid #444; background-color: #0f0707; color: #ffffff;"
                                        onfocus="this.style.borderColor='#0f6fdd'; this.style.boxShadow='0 0 0 3px rgba(15, 111, 221, 0.1)'"
                                        onblur="this.style.borderColor='#444'; this.style.boxShadow=''"
                                    />
                                </div>
                            </div>

                            <!-- Role Selection -->
                            <div class="mt-6">
                                <label class="block text-sm font-semibold mb-3" style="color: #b0bcc4;">
                                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                    User Role <span style="color: #f44336;">*</span>
                                </label>
                                <div class="grid grid-cols-3 gap-3">
                                    @foreach(['admin' => 'Administrator', 'staff' => 'Staff Member', 'customer' => 'Customer'] as $roleValue => $roleLabel)
                                        <label class="relative cursor-pointer group">
                                            <input 
                                                type="radio" 
                                                name="roles" 
                                                value="{{ $roleValue }}"
                                                class="peer absolute opacity-0"
                                                style="pointer-events: none;"
                                                {{ (old('roles') === $roleValue || (is_array($user->roles) && count($user->roles) > 0 && $user->roles[0] === $roleValue && !old('roles'))) ? 'checked' : '' }}
                                                required
                                            />
                                            <div class="p-3 rounded-lg text-center font-semibold text-sm transition-all flex items-center justify-center gap-2" style="border: 2px solid #444; background-color: #0f0707; color: #b0bcc4;">
                                                <span class="radio-circle" style="width: 18px; height: 18px; border-radius: 50%; border: 2px solid #666; display: flex; align-items: center; justify-content: center;">
                                                    <span class="radio-dot" style="width: 10px; height: 10px; border-radius: 50%; background: #0f6fdd; opacity: 0; transition: opacity 0.2s;"></span>
                                                </span>
                                                {{ $roleLabel }}
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                                @error('roles')
                                    <p class="mt-2 text-sm" style="color: #ff6b6b;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex gap-4 mt-6 pt-6 mb-8 justify-center" style="border-top: 2px solid #444;">
                        <a 
                            href="{{ route('admin.users.index') }}" 
                            class="px-8 py-3 rounded-xl font-bold text-center transition-all"
                            style="background-color: #2a2f3a; color: #b0bcc4; border: 2px solid #444;"
                            onmouseover="this.style.backgroundColor='#353a47'; this.style.borderColor='#555'"
                            onmouseout="this.style.backgroundColor='#2a2f3a'; this.style.borderColor='#444'"
                        >
                            <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Cancel
                        </a>
                        <button 
                            type="submit" 
                            class="px-8 py-3 rounded-xl font-bold text-center transition-all"
                            style="background: linear-gradient(135deg, #4caf50 0%, #45a049 100%); color: white; border: 2px solid #4caf50; box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(76, 175, 80, 0.4)'"
                            onmouseout="this.style.transform=''; this.style.boxShadow='0 4px 12px rgba(76, 175, 80, 0.3)'"
                        >
                            <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .peer:checked ~ div {
            background: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%) !important;
            color: #ffffff !important;
            border-color: #0f6fdd !important;
            box-shadow: 0 4px 12px rgba(15, 111, 221, 0.3) !important;
        }
        
        .peer:checked ~ div .radio-circle {
            border-color: #ffffff !important;
        }
        
        .peer:checked ~ div .radio-dot {
            opacity: 1 !important;
            background: #ffffff !important;
        }
        
        .group:hover div {
            border-color: #555 !important;
        }
    </style>

    <script>
        function handleAdminProfilePictureUpload(input, userId) {
            if (input.files && input.files[0]) {
                const formData = new FormData();
                formData.append('profile_picture', input.files[0]);
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('_method', 'PATCH');

                fetch(`/admin/users/${userId}/upload-picture`, {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const preview = document.getElementById('profile-preview');
                        if (preview.tagName === 'IMG') {
                            preview.src = data.url + '?t=' + new Date().getTime();
                        } else {
                            const img = document.createElement('img');
                            img.id = 'profile-preview';
                            img.src = data.url + '?t=' + new Date().getTime();
                            img.className = 'mx-auto';
                            img.style = 'width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid #0f6fdd;';
                            preview.parentNode.replaceChild(img, preview);
                        }
                        
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({ icon: 'success', title: 'Success', text: data.message, timer: 2000 });
                        }
                    }
                })
                .catch(error => {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({ icon: 'error', title: 'Error', text: 'Failed to upload image' });
                    }
                });
            }
        }
    </script>
</x-admin-layout>
