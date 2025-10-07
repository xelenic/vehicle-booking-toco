<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Package;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Review::with('package')->latest();

        // Filter by status
        if ($request->has('status')) {
            if ($request->status === 'approved') {
                $query->where('is_approved', true);
            } elseif ($request->status === 'pending') {
                $query->where('is_approved', false);
            }
        }

        // Filter by featured
        if ($request->has('featured') && $request->featured == '1') {
            $query->where('is_featured', true);
        }

        $reviews = $query->paginate(10);
        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $packages = Package::active()->ordered()->get();
        return view('admin.reviews.create', compact('packages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'customer_location' => 'nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string|max:1000',
            'is_verified' => 'boolean',
            'is_featured' => 'boolean',
            'is_approved' => 'boolean',
            'review_date' => 'nullable|date',
        ]);

        $data = $request->all();
        $data['review_date'] = $request->review_date ?: now();

        Review::create($data);

        // Update package rating and review count
        $this->updatePackageStats($request->package_id);

        return redirect()->route('admin.reviews.index')->with('success', 'Review created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        $review->load('package');
        return view('admin.reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        $packages = Package::active()->ordered()->get();
        return view('admin.reviews.edit', compact('review', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'customer_location' => 'nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string|max:1000',
            'is_verified' => 'boolean',
            'is_featured' => 'boolean',
            'is_approved' => 'boolean',
            'review_date' => 'nullable|date',
        ]);

        $oldPackageId = $review->package_id;
        $data = $request->all();
        $data['review_date'] = $request->review_date ?: $review->review_date;

        $review->update($data);

        // Update package stats for both old and new packages
        $this->updatePackageStats($oldPackageId);
        if ($oldPackageId != $request->package_id) {
            $this->updatePackageStats($request->package_id);
        }

        return redirect()->route('admin.reviews.index')->with('success', 'Review updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $packageId = $review->package_id;
        $review->delete();

        // Update package stats
        $this->updatePackageStats($packageId);

        return redirect()->route('admin.reviews.index')->with('success', 'Review deleted successfully!');
    }

    /**
     * Toggle review approval status.
     */
    public function toggleApproval(Review $review)
    {
        $review->update(['is_approved' => !$review->is_approved]);
        $this->updatePackageStats($review->package_id);

        $status = $review->is_approved ? 'approved' : 'unapproved';
        return redirect()->back()->with('success', "Review {$status} successfully!");
    }

    /**
     * Toggle review featured status.
     */
    public function toggleFeatured(Review $review)
    {
        $review->update(['is_featured' => !$review->is_featured]);
        return redirect()->back()->with('success', 'Review featured status updated successfully!');
    }

    /**
     * Update package rating and review count.
     */
    private function updatePackageStats($packageId)
    {
        $package = Package::find($packageId);
        if ($package) {
            $approvedReviews = $package->approvedReviews();
            $avgRating = $approvedReviews->avg('rating') ?? 0;
            $reviewCount = $approvedReviews->count();
            
            $package->update([
                'rating' => round($avgRating, 1),
                'reviews_count' => $reviewCount,
            ]);
        }
    }
}