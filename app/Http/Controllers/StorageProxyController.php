<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StorageProxyController extends Controller
{
    /**
     * Proxy storage files through Laravel to avoid CORS issues
     * 
     * @param Request $request
     * @return StreamedResponse
     */
    public function show(Request $request)
    {
        // Get the file path from the request (everything after /storage/)
        $path = $request->path();
        $path = str_replace('storage/', '', $path);
        
        // Check if file exists in Supabase storage
        if (!Storage::disk('supabase')->exists($path)) {
            abort(404, 'Image not found');
        }
        
        // Get the file content and mime type
        $file = Storage::disk('supabase')->get($path);
        $mimeType = Storage::disk('supabase')->mimeType($path);
        
        // Return the file with proper headers and caching
        return response($file, 200)
            ->header('Content-Type', $mimeType)
            ->header('Cache-Control', 'public, max-age=31536000') // Cache for 1 year
            ->header('Access-Control-Allow-Origin', '*'); // Allow all origins
    }
}
