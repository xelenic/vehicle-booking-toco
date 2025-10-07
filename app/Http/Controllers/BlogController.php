<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;

class BlogController extends Controller
{
    /**
     * Display a listing of published blogs.
     */
    public function index(Request $request)
    {
        $query = Blog::with('category')->published()->latest();

        // Filter by category if provided
        if ($request->has('category') && $request->category !== 'all') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }

        $blogs = $query->paginate(9);
        $categories = BlogCategory::active()->ordered()->get();
        $featuredBlogs = Blog::with('category')->published()->featured()->latest()->limit(3)->get();

        return view('blog.index', compact('blogs', 'categories', 'featuredBlogs'));
    }

    /**
     * Display the specified blog post.
     */
    public function show($slug)
    {
        $blog = Blog::with('category')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // Increment views count
        $blog->incrementViews();

        // Get related blogs
        $relatedBlogs = $blog->getRelatedBlogs(3);

        // Get recent blogs
        $recentBlogs = Blog::with('category')
            ->published()
            ->where('id', '!=', $blog->id)
            ->latest()
            ->limit(5)
            ->get();

        return view('blog.show', compact('blog', 'relatedBlogs', 'recentBlogs'));
    }

    /**
     * Display blogs by category.
     */
    public function category($slug)
    {
        $category = BlogCategory::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $blogs = Blog::with('category')
            ->published()
            ->byCategory($category->id)
            ->latest()
            ->paginate(9);

        $categories = BlogCategory::active()->ordered()->get();

        return view('blog.category', compact('blogs', 'category', 'categories'));
    }

    /**
     * Search blogs.
     */
    public function search(Request $request)
    {
        $search = $request->get('q');
        
        if (!$search) {
            return redirect()->route('blog.index');
        }

        $blogs = Blog::with('category')
            ->published()
            ->search($search)
            ->latest()
            ->paginate(9);

        $categories = BlogCategory::active()->ordered()->get();

        return view('blog.search', compact('blogs', 'search', 'categories'));
    }
}