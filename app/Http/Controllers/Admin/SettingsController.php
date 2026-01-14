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
        $favicon = Setting::where('key', 'site_favicon')->first();
        return view('admin.settings.index', compact('logo', 'favicon'));
    }

    public function updateLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $setting = Setting::firstOrCreate(['key' => 'site_logo']);

        // Delete old logo if exists
        if ($setting->value && Storage::disk('supabase')->exists($setting->value)) {
            Storage::disk('supabase')->delete($setting->value);
        }

        // Store new logo
        $path = $request->file('logo')->store('logos', 'supabase');
        $setting->value = $path;
        $setting->save();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Logo updated successfully!');
    }

    public function updateFavicon(Request $request)
    {
        $request->validate([
            'favicon' => 'required|mimes:ico,png,svg+xml|max:500',
        ]);

        $setting = Setting::firstOrCreate(['key' => 'site_favicon']);

        // Delete old favicon if exists
        if ($setting->value && Storage::disk('supabase')->exists($setting->value)) {
            Storage::disk('supabase')->delete($setting->value);
        }

        // Store new favicon
        $path = $request->file('favicon')->store('favicons', 'supabase');
        $setting->value = $path;
        $setting->save();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Favicon updated successfully!');
    }
}
