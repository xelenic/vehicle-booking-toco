<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Blog;
use App\Models\PackageCategory;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SearchController extends Controller
{
    /**
     * Display search results page
     */
    public function results(Request $request)
    {
        $query = $request->get('q', '');
        $type = $request->get('type', 'all'); // all, packages, blogs
        $category = $request->get('category', '');
        
        $packages = collect();
        $blogs = collect();
        $packageCategories = PackageCategory::where('is_active', true)->get();
        $blogCategories = BlogCategory::where('is_active', true)->get();
        
        if (!empty($query)) {
            if ($type === 'all' || $type === 'packages') {
                $packagesQuery = Package::where('is_active', true)
                    ->where(function($q) use ($query) {
                        $q->where('title', 'like', "%{$query}%")
                          ->orWhere('description', 'like', "%{$query}%")
                          ->orWhere('short_description', 'like', "%{$query}%");
                    });
                
                if ($category) {
                    $packagesQuery->where('package_category_id', $category);
                }
                
                $packages = $packagesQuery->with('category')->paginate(12);
            }
            
            if ($type === 'all' || $type === 'blogs') {
                $blogsQuery = Blog::where('is_published', true)
                    ->where(function($q) use ($query) {
                        $q->where('title', 'like', "%{$query}%")
                          ->orWhere('content', 'like', "%{$query}%")
                          ->orWhere('excerpt', 'like', "%{$query}%");
                    });
                
                if ($category) {
                    $blogsQuery->where('blog_category_id', $category);
                }
                
                $blogs = $blogsQuery->with('category')->paginate(12);
            }
        }
        
        // Calculate total results
        $totalResults = 0;
        if ($type === 'all' || $type === 'packages') {
            $totalResults += $packages->total();
        }
        if ($type === 'all' || $type === 'blogs') {
            $totalResults += $blogs->total();
        }
        
        return view('search.results', compact('query', 'type', 'category', 'packages', 'blogs', 'packageCategories', 'blogCategories', 'totalResults'));
    }
    
    /**
     * API endpoint for search suggestions
     */
    public function search(Request $request): JsonResponse
    {
        $query = $request->get('q', '');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }
        
        $results = collect();
        
        // Search packages
        $packages = Package::where('is_active', true)
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('short_description', 'like', "%{$query}%");
            })
            ->with('category')
            ->limit(5)
            ->get()
            ->map(function($package) {
                return [
                    'id' => $package->id,
                    'title' => $package->title,
                    'type' => 'package',
                    'url' => route('package-details', $package->slug),
                    'image' => $package->image_url,
                    'category' => $package->category->name,
                    'price' => $package->formatted_price,
                ];
            });
        
        // Search blogs
        $blogs = Blog::where('is_published', true)
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('excerpt', 'like', "%{$query}%");
            })
            ->with('category')
            ->limit(5)
            ->get()
            ->map(function($blog) {
                return [
                    'id' => $blog->id,
                    'title' => $blog->title,
                    'type' => 'blog',
                    'url' => route('blog.show', $blog->slug),
                    'image' => $blog->featured_image_url,
                    'category' => $blog->category->name,
                    'date' => $blog->published_at->format('M d, Y'),
                ];
            });
        
        $results = $packages->concat($blogs)->take(10);
        
        return response()->json($results);
    }
}