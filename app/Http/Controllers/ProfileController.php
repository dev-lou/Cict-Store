<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Update user profile picture.
     */
    public function updatePicture(Request $request)
    {
        try {
            // Validate the uploaded file
            $validated = $request->validate([
                'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
            ]);

            $user = auth()->user();

            // Delete old picture if it exists
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Store new picture with sanitized filename to prevent path traversal
            $file = $request->file('profile_picture');
            $originalName = $file->getClientOriginalName();
            
            // Sanitize filename - remove directory traversal attempts and special characters
            $sanitizedName = preg_replace('/[^a-zA-Z0-9_\-\.]/', '_', $originalName);
            $sanitizedName = str_replace(['..', '/', '\\'], '', $sanitizedName);
            
            // Generate unique filename
            $filename = auth()->id() . '_' . time() . '_' . $sanitizedName;
            
            // Store in profile-pictures directory only
            $path = $file->storeAs('profile-pictures', $filename, 'public');

            // Validate stored path doesn't escape directory
            if (!str_starts_with($path, 'profile-pictures/')) {
                throw new \Exception('Invalid file path detected');
            }

            // Update user record
            $user->update(['profile_picture' => $path]);

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
     * Update user name.
     */
    public function updateName(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        auth()->user()->update(['name' => $validated['name']]);

        return redirect()->route('profile.show')->with('success', 'Name updated successfully!');
    }

    /**
     * Update user email.
     */
    public function updateEmail(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email,' . auth()->id(),
        ]);

        auth()->user()->update(['email' => $validated['email']]);

        return redirect()->route('profile.show')->with('success', 'Email updated successfully!');
    }

    /**
     * Update user password.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        auth()->user()->update(['password' => Hash::make($validated['password'])]);

        return redirect()->route('profile.show')->with('success', 'Password updated successfully!');
    }
}
