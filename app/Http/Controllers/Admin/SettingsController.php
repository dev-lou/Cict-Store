<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $logo = Setting::where('key', 'site_logo')->first();
        return view('admin.settings.index', compact('logo'));
    }

    public function updateLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $setting = Setting::firstOrCreate(['key' => 'site_logo']);

        // Delete old logo if exists
        if ($setting->value && Storage::disk('public')->exists($setting->value)) {
            Storage::disk('public')->delete($setting->value);
        }

        // Store new logo
        $path = $request->file('logo')->store('logos', 'public');
        $setting->value = $path;
        $setting->save();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Logo updated successfully!');
    }
}
