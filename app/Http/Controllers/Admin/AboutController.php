<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    /**
     * Display the about page management
     */
    public function index()
    {
        $about = About::with('heroMedia')->first();
        return view('admin.about.index', compact('about'));
    }

    /**
     * Show the form for creating/editing the about page
     */
    public function create()
    {
        $about = About::with('heroMedia')->first();
        return view('admin.about.create', compact('about'));
    }

    /**
     * Store or update the about page
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'content' => 'required|string',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'values' => 'nullable|array',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_media_id' => 'nullable|exists:media,id',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'exists:media,id',
            'features' => 'nullable|array',
            'team_members' => 'nullable|array',
            'team_member_images' => 'nullable|array',
            'team_member_images.*' => 'exists:media,id',
            'statistics' => 'nullable|array',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0'
        ]);

        $data = $request->all();

        // Handle hero image upload or media selection
        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $request->file('hero_image')->store('about', 'public');
        } elseif ($request->has('hero_media_id')) {
            $media = \App\Models\Media::find($request->hero_media_id);
            if ($media) {
                $data['hero_image'] = $media->path;
            }
        }

        // Handle boolean fields
        $data['is_active'] = $request->has('is_active');

        // Check if about page already exists
        $about = About::first();
        
        if ($about) {
            // Update existing about page
            $about->update($data);
            $message = 'About page updated successfully!';
        } else {
            // Create new about page
            About::create($data);
            $message = 'About page created successfully!';
        }

        return redirect()->route('admin.about.index')
            ->with('success', $message);
    }

    /**
     * Show the form for editing the about page
     */
    public function edit()
    {
        $about = About::with('heroMedia')->first();
        
        if (!$about) {
            return redirect()->route('admin.about.create')
                ->with('info', 'No about page found. Please create one first.');
        }
        
        return view('admin.about.edit', compact('about'));
    }

    /**
     * Update the about page
     */
    public function update(Request $request)
    {
        $about = About::first();
        
        if (!$about) {
            return redirect()->route('admin.about.create')
                ->with('error', 'No about page found. Please create one first.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'content' => 'required|string',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'values' => 'nullable|array',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_media_id' => 'nullable|exists:media,id',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'exists:media,id',
            'features' => 'nullable|array',
            'team_members' => 'nullable|array',
            'team_member_images' => 'nullable|array',
            'team_member_images.*' => 'exists:media,id',
            'statistics' => 'nullable|array',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0'
        ]);

        $data = $request->all();

        // Handle hero image upload or media selection
        if ($request->hasFile('hero_image')) {
            // Delete old image
            if ($about->hero_image && !str_starts_with($about->hero_image, 'slider/')) {
                Storage::disk('public')->delete($about->hero_image);
            }
            $data['hero_image'] = $request->file('hero_image')->store('about', 'public');
        } elseif ($request->has('hero_media_id')) {
            $media = \App\Models\Media::find($request->hero_media_id);
            if ($media) {
                $data['hero_image'] = $media->path;
            }
        }

        // Handle boolean fields
        $data['is_active'] = $request->has('is_active');

        $about->update($data);

        return redirect()->route('admin.about.index')
            ->with('success', 'About page updated successfully!');
    }

    /**
     * Remove the about page
     */
    public function destroy()
    {
        $about = About::first();
        
        if (!$about) {
            return redirect()->route('admin.about.index')
                ->with('error', 'No about page found to delete.');
        }

        // Delete hero image
        if ($about->hero_image && !str_starts_with($about->hero_image, 'slider/')) {
            Storage::disk('public')->delete($about->hero_image);
        }

        $about->delete();

        return redirect()->route('admin.about.index')
            ->with('success', 'About page deleted successfully!');
    }
}
