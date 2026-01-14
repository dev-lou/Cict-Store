<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AuditLog;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserManageController extends Controller
{
    /**
     * Display all users.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search by name or email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        // Filter by role
        if ($request->filled('role')) {
            $role = $request->role;
            $query->whereJsonContains('roles', $role);
        }

        $users = $query->paginate(15);

        return view('admin.users.index', [
            'users' => $users,
            'roles' => ['admin', 'staff', 'customer'],
        ]);
    }

    /**
     * Display the create user form.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a new user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|in:admin,staff,customer',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'roles' => json_encode([$validated['roles']]),
        ]);

        // Log the action
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'model' => 'User',
            'model_id' => $user->id,
            'new_values' => [
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $validated['roles'],
            ],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return redirect()->route('admin.users.index')
                       ->with('success', "User {$user->name} created successfully!");
    }

    /**
     * Display the edit user form.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => ['admin', 'staff', 'customer'],
        ]);
    }

    /**
     * Update a user.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'required|in:admin,staff,customer',
        ]);

        // Track changes for audit log
        $changes = [];
        
        if ($user->name !== $validated['name']) {
            $changes['name'] = ['from' => $user->name, 'to' => $validated['name']];
        }
        
        if ($user->email !== $validated['email']) {
            $changes['email'] = ['from' => $user->email, 'to' => $validated['email']];
        }
        
        $oldRoles = $user->roles ?? [];
        $newRoles = [$validated['roles']];
        if ($oldRoles !== $newRoles) {
            $changes['roles'] = ['from' => $oldRoles, 'to' => $newRoles];
        }
        
        if ($validated['password'] ?? null) {
            $changes['password'] = 'Password changed';
            $user->password = Hash::make($validated['password']);
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->roles = json_encode($newRoles);
        $user->save();

        // Log the action
        if (!empty($changes)) {
            AuditLog::create([
                'user_id' => auth()->id(),
                'action' => 'update',
                'model' => 'User',
                'model_id' => $user->id,
                'old_values' => [],
                'new_values' => $changes,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }

        return redirect()->route('admin.users.index')
                       ->with('success', "User {$user->name} updated successfully!");
    }

    /**
     * Delete a user.
     */
    public function destroy(User $user)
    {
        // Prevent deletion of current authenticated user
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                           ->with('error', 'You cannot delete your own account!');
        }

        $userName = $user->name;
        $userEmail = $user->email;
        
        // Log the action before deletion
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'model' => 'User',
            'model_id' => $user->id,
            'old_values' => [
                'name' => $userName,
                'email' => $userEmail,
                'roles' => $user->roles ?? [],
            ],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        $user->delete();

        return redirect()->route('admin.users.index')
                       ->with('success', "User {$userName} deleted successfully!");
    }

    /**
     * Display the admin settings page.
     */
    public function settings()
    {
        $stats = [
            'total_users' => User::count(),
            'total_orders' => Order::count(),
            'active_inventory' => Product::where('status', 'active')->count(),
            'system_uptime' => '99.9%',
        ];

        $siteName = config('app.name', 'CICT Dingle');
        $logo = Setting::where('key', 'site_logo')->first();
        $favicon = Setting::where('key', 'site_favicon')->first();

        return view('admin.settings.index', compact('stats', 'siteName', 'logo', 'favicon'));
    }

    /**
     * Update site settings.
     */
    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:1024',
        ]);

        try {
            // Handle logo upload
            if ($request->hasFile('logo')) {
                $logoFile = $request->file('logo');
                $logoPath = Storage::disk('supabase')->putFile('settings', $logoFile, 'public');
                
                $logoSetting = Setting::firstOrNew(['key' => 'site_logo']);
                $logoSetting->value = $logoPath;
                $logoSetting->save();
            }

            // Handle favicon upload
            if ($request->hasFile('favicon')) {
                $faviconFile = $request->file('favicon');
                $faviconPath = Storage::disk('supabase')->putFile('settings', $faviconFile, 'public');
                
                $faviconSetting = Setting::firstOrNew(['key' => 'site_favicon']);
                $faviconSetting->value = $faviconPath;
                $faviconSetting->save();
            }

            // If AJAX request, return JSON
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Settings updated successfully!'
                ]);
            }

            return redirect()->route('admin.settings')
                           ->with('success', 'Settings updated successfully!');
        } catch (\Exception $e) {
            // If AJAX request, return JSON error
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update site name: ' . $e->getMessage()
                ], 400);
            }

            return redirect()->route('admin.settings')
                           ->with('error', 'Failed to update site name: ' . $e->getMessage());
        }
    }

    /**
     * Update user profile picture.
     */
    public function updatePicture(Request $request, User $user)
    {
        try {
            $validated = $request->validate([
                'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            ]);

            // Delete old picture if exists
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Store new picture
            $path = $request->file('profile_picture')->store('profile-pictures', 'public');

            // Update user
            $user->update(['profile_picture' => $path]);

            // Log action
            AuditLog::create([
                'user_id' => auth()->id(),
                'action' => 'update',
                'model' => 'User',
                'model_id' => $user->id,
                'new_values' => ['profile_picture' => 'Updated'],
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Profile picture updated successfully',
                'picture_url' => asset('storage/' . $path),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    /**
     * Update site logo.
     */
    public function updateLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        try {
            $setting = Setting::firstOrCreate(['key' => 'site_logo']);

            // Delete old logo if exists and it's not the default
            if ($setting->value && $setting->value !== 'images/ctrlp-logo.png' && Storage::disk('supabase')->exists($setting->value)) {
                Storage::disk('supabase')->delete($setting->value);
            }

            // Store new logo in Supabase
            $path = $request->file('logo')->store('logos', 'supabase');
            $setting->value = $path;
            $setting->save();

            // Log action
            AuditLog::create([
                'user_id' => auth()->id(),
                'action' => 'update',
                'model' => 'Setting',
                'model_id' => $setting->id,
                'new_values' => ['logo' => $path],
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);

            return redirect()->route('admin.settings.index')
                ->with('success', 'Logo updated successfully! The new logo is now displayed across your site.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update logo: ' . $e->getMessage());
        }
    }

    /**
     * Update site favicon.
     */
    public function updateFavicon(Request $request)
    {
        $request->validate([
            'favicon' => 'required|mimes:ico,png,svg+xml|max:500',
        ]);

        try {
            $setting = Setting::firstOrCreate(['key' => 'site_favicon']);

            // Delete old favicon if exists
            if ($setting->value && Storage::disk('supabase')->exists($setting->value)) {
                Storage::disk('supabase')->delete($setting->value);
            }

            // Store new favicon in Supabase
            $path = $request->file('favicon')->store('favicons', 'supabase');
            $setting->value = $path;
            $setting->save();

            // Log action
            AuditLog::create([
                'user_id' => auth()->id(),
                'action' => 'update',
                'model' => 'Setting',
                'model_id' => $setting->id,
                'new_values' => ['favicon' => $path],
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);

            return redirect()->route('admin.settings.index')
                ->with('success', 'Favicon updated successfully! The new favicon is now displayed in browser tabs.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update favicon: ' . $e->getMessage());
        }
    }
}

