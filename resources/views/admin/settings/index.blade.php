<x-admin-layout>
    @section('page-title', 'Admin Settings')

    <!-- Breadcrumb -->
    <x-admin.breadcrumb :items="[
        ['label' => 'System'],
        ['label' => 'Settings']
    ]" />

    <!-- Success Message -->
    @if(session('success'))
        <x-admin.alert type="success" :message="session('success')" :dismissible="true" />
    @endif

    <!-- Page Header -->
    <x-admin.page-header title="Admin Settings" subtitle="Manage application settings, system configuration, and preferences">
        <x-slot:actions>
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);">
                <svg class="w-6 h-6" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
        </x-slot:actions>
    </x-admin.page-header>

    <!-- Settings Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- General Settings Card -->
        <div class="lg:col-span-2 rounded-2xl shadow-2xl overflow-hidden" style="background: linear-gradient(180deg, #1a1f2e 0%, #0f1419 100%); border: 2px solid #b0bcc4; border-radius: 20px;">
            <!-- Card Top Border -->
            <div style="height: 3px; background: linear-gradient(90deg, #0f6fdd 0%, #b0bcc4 50%, #0f6fdd 100%);"></div>

            <div class="p-8">
                <div class="flex items-center gap-3 mb-8">
                    <div style="background-color: #0f6fdd; padding: 10px 14px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <svg class="w-5 h-5" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold" style="color: #ffffff;">General Settings</h2>
                        <p class="text-xs mt-1" style="color: #b0bcc4;">System information and core configuration</p>
                    </div>
                </div>

                <!-- Site Name Display -->
                <div style="background: rgba(15, 111, 221, 0.1); border: 2px solid rgba(15, 111, 221, 0.3); border-radius: 12px; padding: 16px;">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-5 h-5" fill="none" stroke="#0f6fdd" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-sm font-bold" style="color: #0f6fdd;">Site Name Configuration</p>
                    </div>
                    <p class="text-xs mb-3" style="color: #b0bcc4;">Site name is configured via environment variables (APP_NAME). Update it in your hosting platform's environment settings and redeploy.</p>
                    <div class="mt-3 pt-3" style="border-top: 1px solid rgba(15, 111, 221, 0.2);">
                        <p class="text-xs mb-1" style="color: #b0bcc4;">Current Site Name:</p>
                        <p class="text-xl font-bold" style="color: #ffffff;">{{ config('app.name', 'CICT Dingle') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats Card -->
        <div class="rounded-2xl shadow-2xl overflow-hidden" style="background: linear-gradient(180deg, #1a1f2e 0%, #0f1419 100%); border: 2px solid #b0bcc4; border-radius: 20px;">
            <!-- Card Top Border -->
            <div style="height: 3px; background: linear-gradient(90deg, #0f6fdd 0%, #b0bcc4 50%, #0f6fdd 100%);"></div>

            <div class="p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div style="background-color: #0f6fdd; padding: 10px 14px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <svg class="w-5 h-5" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h2 class="text-lg font-bold" style="color: #ffffff;">Quick Stats</h2>
                </div>

                <div class="space-y-4">
                    <!-- Stat Item 1 -->
                    <div style="padding: 12px; border-radius: 10px; background-color: #0f0707; border: 2px solid #444; display: flex; justify-content: space-between; align-items: center;">
                        <span style="color: #b0bcc4; font-size: 0.875rem; font-weight: 500;">Total Users</span>
                        <span style="color: #ffffff; font-size: 1.25rem; font-weight: bold;">{{ $stats['total_users'] }}</span>
                    </div>

                    <!-- Stat Item 2 -->
                    <div style="padding: 12px; border-radius: 10px; background-color: #0f0707; border: 2px solid #444; display: flex; justify-content: space-between; align-items: center;">
                        <span style="color: #b0bcc4; font-size: 0.875rem; font-weight: 500;">Total Orders</span>
                        <span style="color: #ffffff; font-size: 1.25rem; font-weight: bold;">{{ $stats['total_orders'] }}</span>
                    </div>

                    <!-- Stat Item 3 -->
                    <div style="padding: 12px; border-radius: 10px; background-color: #0f0707; border: 2px solid #444; display: flex; justify-content: space-between; align-items: center;">
                        <span style="color: #b0bcc4; font-size: 0.875rem; font-weight: 500;">Active Inventory</span>
                        <span style="color: #ffffff; font-size: 1.25rem; font-weight: bold;">{{ $stats['active_inventory'] }}</span>
                    </div>

                    <!-- Stat Item 4 -->
                    <div style="padding: 12px; border-radius: 10px; background-color: #0f0707; border: 2px solid #444; display: flex; justify-content: space-between; align-items: center;">
                        <span style="color: #b0bcc4; font-weight: 500;">System Uptime</span>
                        <span style="color: #4caf50; font-size: 1.25rem; font-weight: bold;">{{ $stats['system_uptime'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Logo Management Section -->
    <div class="rounded-2xl shadow-2xl overflow-hidden mb-8" style="background: linear-gradient(180deg, #1a1f2e 0%, #0f1419 100%); border: 2px solid #b0bcc4; border-radius: 20px;">
        <div style="height: 3px; background: linear-gradient(90deg, #0f6fdd 0%, #b0bcc4 50%, #0f6fdd 100%);"></div>

        <div class="p-8">
            <div class="flex items-center gap-3 mb-8">
                <div style="background-color: #0f6fdd; padding: 10px 14px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <svg class="w-5 h-5" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold" style="color: #ffffff;">Site Logo</h2>
                    <p class="text-xs mt-1" style="color: #b0bcc4;">Upload a logo that will be displayed across your site</p>
                </div>
            </div>

            <form action="{{ route('admin.settings.update-logo') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Logo Preview -->
                    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                        <label style="display: block; color: #b0bcc4; font-weight: 600; margin-bottom: 16px; font-size: 0.875rem; text-align: center;">Current Logo</label>
                        <div style="width: 200px; height: 200px; border-radius: 50%; border: 2px solid #444; overflow: hidden; display: flex; align-items: center; justify-content: center; background: #0f0707;">
                            @if($logo && $logo->value)
                                <img src="{{ Storage::disk('supabase')->url($logo->value) }}" alt="Site Logo" id="logoPreview" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div id="logoPreview" style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #666; font-size: 3rem;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 80px; height: 80px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Upload Form -->
                    <div class="lg:col-span-2">
                        <label style="display: block; color: #b0bcc4; font-weight: 600; margin-bottom: 12px; font-size: 0.875rem;">Upload New Logo</label>
                        <input 
                            type="file" 
                            name="logo" 
                            accept="image/*" 
                            required
                            onchange="previewLogoUpload(this)"
                            style="display: block; width: 100%; padding: 12px; background: #0f0707; border: 2px solid #444; border-radius: 10px; color: #ffffff; margin-bottom: 16px;"
                        >
                        
                        <div style="background: rgba(15, 111, 221, 0.1); border: 2px solid #0f6fdd; border-radius: 10px; padding: 16px; margin-bottom: 24px;">
                            <p style="color: #b0bcc4; font-size: 0.875rem; margin: 0; line-height: 1.6;">
                                <strong style="color: #0f6fdd;">📌 Logo Guidelines:</strong><br>
                                • Square image recommended (500x500px or larger)<br>
                                • Accepted formats: PNG, JPG, GIF, SVG, WebP<br>
                                • Maximum file size: 2MB<br>
                                • Logo will be displayed in: Homepage About section, Footer, and Admin Sidebar
                            </p>
                        </div>

                        <button 
                            type="submit" 
                            class="px-6 py-3 rounded-lg font-bold transition-all duration-300 flex items-center gap-2"
                            style="background: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%); color: white; border: 2px solid #1a7fff; box-shadow: 0 4px 12px rgba(15, 111, 221, 0.3);"
                            onmouseover="this.style.boxShadow='0 8px 20px rgba(15, 111, 221, 0.4)'; this.style.transform='translateY(-2px)'"
                            onmouseout="this.style.boxShadow='0 4px 12px rgba(15, 111, 221, 0.3)'; this.style.transform='translateY(0)'"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            Upload Logo
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Favicon Management Section -->
    <div class="rounded-2xl shadow-2xl overflow-hidden mb-8" style="background: linear-gradient(180deg, #1a1f2e 0%, #0f1419 100%); border: 2px solid #b0bcc4; border-radius: 20px;">
        <div style="height: 3px; background: linear-gradient(90deg, #0f6fdd 0%, #b0bcc4 50%, #0f6fdd 100%);"></div>

        <div class="p-8">
            <div class="flex items-center gap-3 mb-8">
                <div style="background-color: #0f6fdd; padding: 10px 14px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <svg class="w-5 h-5" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold" style="color: #ffffff;">Favicon</h2>
                    <p class="text-xs mt-1" style="color: #b0bcc4;">Upload a favicon that appears in browser tabs</p>
                </div>
            </div>

            <form action="{{ route('admin.settings.update-favicon') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Favicon Preview -->
                    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                        <label style="display: block; color: #b0bcc4; font-weight: 600; margin-bottom: 16px; font-size: 0.875rem; text-align: center;">Current Favicon</label>
                        <div style="width: 120px; height: 120px; border-radius: 12px; border: 2px solid #444; overflow: hidden; display: flex; align-items: center; justify-content: center; background: #0f0707;">
                            @if($favicon && $favicon->value)
                                <img src="{{ Storage::disk('supabase')->url($favicon->value) }}" alt="Site Favicon" id="faviconPreview" style="width: 64px; height: 64px; object-fit: contain;">
                            @else
                                <div id="faviconPreview" style="width: 64px; height: 64px; display: flex; align-items: center; justify-content: center; color: #666; font-size: 2rem;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 48px; height: 48px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Upload Form -->
                    <div class="lg:col-span-2">
                        <label style="display: block; color: #b0bcc4; font-weight: 600; margin-bottom: 12px; font-size: 0.875rem;">Upload New Favicon</label>
                        <input 
                            type="file" 
                            name="favicon" 
                            accept="image/x-icon,image/png,image/svg+xml" 
                            required
                            onchange="previewFaviconUpload(this)"
                            style="display: block; width: 100%; padding: 12px; background: #0f0707; border: 2px solid #444; border-radius: 10px; color: #ffffff; margin-bottom: 16px;"
                        >
                        
                        <div style="background: rgba(15, 111, 221, 0.1); border: 2px solid #0f6fdd; border-radius: 10px; padding: 16px; margin-bottom: 24px;">
                            <p style="color: #b0bcc4; font-size: 0.875rem; margin: 0; line-height: 1.6;">
                                <strong style="color: #0f6fdd;">📌 Favicon Guidelines:</strong><br>
                                • Square icon recommended (32x32px or 64x64px)<br>
                                • Accepted formats: ICO, PNG, SVG<br>
                                • Maximum file size: 500KB<br>
                                • Favicon appears in browser tabs and bookmarks
                            </p>
                        </div>

                        <button 
                            type="submit" 
                            class="px-6 py-3 rounded-lg font-bold transition-all duration-300 flex items-center gap-2"
                            style="background: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%); color: white; border: 2px solid #1a7fff; box-shadow: 0 4px 12px rgba(15, 111, 221, 0.3);"
                            onmouseover="this.style.boxShadow='0 8px 20px rgba(15, 111, 221, 0.4)'; this.style.transform='translateY(-2px)'"
                            onmouseout="this.style.boxShadow='0 4px 12px rgba(15, 111, 221, 0.3)'; this.style.transform='translateY(0)'"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            Upload Favicon
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <script>
        // Handle form submission with AJAX
        document.getElementById('settingsForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const csrfToken = document.querySelector('input[name="_token"]').value;
            
            fetch('{{ route("admin.settings.update") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    // Show success alert
                    Swal.fire({
                        title: 'Success!',
                        text: 'Site name changed successfully!',
                        icon: 'success',
                        confirmButtonColor: '#4caf50',
                        background: '#0f1419',
                        color: '#ffffff',
                        titleColor: '#4caf50',
                        iconColor: '#4caf50',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            document.querySelector('.swal2-popup').style.border = '3px solid #b0bcc4';
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Stay on the same settings page (don't redirect to dashboard)
                            location.reload();
                        }
                    });
                } else {
                    // Show error alert
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to update site name. Please try again.',
                        icon: 'error',
                        confirmButtonColor: '#f44336',
                        background: '#0f1419',
                        color: '#ffffff',
                        titleColor: '#f44336',
                        iconColor: '#f44336',
                        didOpen: () => {
                            document.querySelector('.swal2-popup').style.border = '3px solid #b0bcc4';
                        }
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred. Please try again.',
                    icon: 'error',
                    confirmButtonColor: '#f44336',
                    background: '#0f1419',
                    color: '#ffffff',
                    titleColor: '#f44336',
                    iconColor: '#f44336',
                    didOpen: () => {
                        document.querySelector('.swal2-popup').style.border = '3px solid #b0bcc4';
                    }
                });
            });
        });

        // Reset form button functionality
        function resetForm() {
            document.getElementById('settingsForm').reset();
            // Reload to get original values
            location.reload();
        }

        // Logo preview function
        function previewLogoUpload(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('logoPreview');
                    if (preview.tagName === 'IMG') {
                        preview.src = e.target.result;
                    } else {
                        preview.innerHTML = `<img src="${e.target.result}" alt="Logo Preview" id="logoPreview" style="width: 100%; height: 100%; object-fit: cover;">`;
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Favicon preview function
        function previewFaviconUpload(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('faviconPreview');
                    if (preview.tagName === 'IMG') {
                        preview.src = e.target.result;
                    } else {
                        preview.innerHTML = `<img src="${e.target.result}" alt="Favicon Preview" id="faviconPreview" style="width: 64px; height: 64px; object-fit: contain;">`;
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Show SweetAlert if success message is present in session (for page reload scenarios)
        @if(session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonColor: '#4caf50',
                background: '#0f1419',
                color: '#ffffff',
                titleColor: '#4caf50',
                iconColor: '#4caf50',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    document.querySelector('.swal2-popup').style.border = '3px solid #b0bcc4';
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            });
        @endif
    </script>
</x-admin-layout>
