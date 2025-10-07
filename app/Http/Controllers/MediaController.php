<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;

class MediaController extends Controller
{
    /**
     * Display a listing of media files
     */
    public function index(Request $request)
    {
        $query = Media::active()->images();

        // Filter by folder if provided
        if ($request->has('folder') && $request->folder) {
            $query->inFolder($request->folder);
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('original_name', 'like', '%' . $request->search . '%')
                  ->orWhere('title', 'like', '%' . $request->search . '%')
                  ->orWhere('alt_text', 'like', '%' . $request->search . '%');
            });
        }

        $media = $query->orderBy('created_at', 'desc')->paginate(20);

        if ($request->expectsJson()) {
            return response()->json([
                'media' => $media->items(),
                'pagination' => [
                    'current_page' => $media->currentPage(),
                    'last_page' => $media->lastPage(),
                    'per_page' => $media->perPage(),
                    'total' => $media->total(),
                ]
            ]);
        }

        return view('admin.media.index', compact('media'));
    }

    /**
     * Store a newly uploaded media file
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB max
            'folder' => 'nullable|string|max:255',
            'alt_text' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $file = $request->file('file');
        $folder = $request->input('folder', 'uploads');
        
        // Generate unique filename
        $extension = $file->getClientOriginalExtension();
        $filename = Str::uuid() . '.' . $extension;
        
        // Store file
        $path = $file->storeAs($folder, $filename, 'public');

        // Create media record
        $media = Media::create([
            'filename' => $filename,
            'original_name' => $file->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'alt_text' => $request->input('alt_text'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'folder' => $folder,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'File uploaded successfully',
            'media' => [
                'id' => $media->id,
                'filename' => $media->filename,
                'original_name' => $media->original_name,
                'url' => $media->url,
                'alt_text' => $media->alt_text,
                'title' => $media->title,
                'size' => $media->size,
                'mime_type' => $media->mime_type,
            ]
        ]);
    }

    /**
     * Display the specified media file
     */
    public function show(Media $media): JsonResponse
    {
        return response()->json([
            'id' => $media->id,
            'filename' => $media->filename,
            'original_name' => $media->original_name,
            'url' => $media->url,
            'alt_text' => $media->alt_text,
            'title' => $media->title,
            'description' => $media->description,
            'size' => $media->size,
            'mime_type' => $media->mime_type,
            'folder' => $media->folder,
            'created_at' => $media->created_at,
        ]);
    }

    /**
     * Update media metadata
     */
    public function update(Request $request, Media $media): JsonResponse
    {
        $request->validate([
            'alt_text' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $media->update($request->only(['alt_text', 'title', 'description']));

        return response()->json([
            'success' => true,
            'message' => 'Media updated successfully',
            'media' => $media
        ]);
    }

    /**
     * Delete media file
     */
    public function destroy(Media $media): JsonResponse
    {
        // Delete physical file
        if (Storage::disk('public')->exists($media->path)) {
            Storage::disk('public')->delete($media->path);
        }

        // Delete database record
        $media->delete();

        return response()->json([
            'success' => true,
            'message' => 'Media deleted successfully'
        ]);
    }

    /**
     * Get media for selection (for use in forms)
     */
    public function getForSelection(Request $request): JsonResponse
    {
        try {
            $query = Media::active()->images();

            if ($request->has('folder') && $request->folder) {
                $query->inFolder($request->folder);
            }

            if ($request->has('search') && $request->search) {
                $query->where(function($q) use ($request) {
                    $q->where('original_name', 'like', '%' . $request->search . '%')
                      ->orWhere('title', 'like', '%' . $request->search . '%');
                });
            }

            $media = $query->orderBy('created_at', 'desc')->limit(50)->get();

            return response()->json([
                'success' => true,
                'media' => $media->map(function($item) {
                    return [
                        'id' => $item->id,
                        'filename' => $item->filename,
                        'original_name' => $item->original_name,
                        'url' => $item->url,
                        'alt_text' => $item->alt_text,
                        'title' => $item->title,
                        'size' => $item->size,
                        'folder' => $item->folder,
                    ];
                })
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in getForSelection: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error loading media: ' . $e->getMessage(),
                'media' => []
            ], 500);
        }
    }

    /**
     * Get folders list
     */
    public function getFolders(): JsonResponse
    {
        $folders = Media::active()
            ->select('folder')
            ->distinct()
            ->orderBy('folder')
            ->pluck('folder');

        return response()->json([
            'folders' => $folders
        ]);
    }
}