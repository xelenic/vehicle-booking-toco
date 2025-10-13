<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\PackageCategory;
use App\Models\Review;
use App\Models\Location;
use App\Models\Vehicle;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured packages for the home page
        $tourPackages = Package::with(['category', 'media'])
            ->active()
            ->featured()
            ->ordered()
            ->limit(6)
            ->get()
            ->map(function ($package) {
                return [
                    'id' => $package->id,
                    'title' => $package->title,
                    'slug' => $package->slug,
                    'description' => $package->description,
                    'duration' => $package->duration,
                    'price' => $package->formatted_price,
                    'original_price' => $package->formatted_original_price,
                    'image' => $package->image_url,
                    'highlights' => $package->highlights ?? [],
                    'category' => $package->category->name,
                    'rating' => $package->rating,
                    'reviews_count' => $package->reviews_count,
                    'difficulty' => $package->difficulty,
                    'group_size' => $package->group_size
                ];
            });

        // Get featured reviews for the home page
        $featuredReviews = Review::with('package')
            ->featured()
            ->approved()
            ->latest()
            ->limit(6)
            ->get();

        // Get active locations for the booking form
        $locations = Location::active()
            ->orderBy('name')
            ->get();

        // Prepare locations data for JavaScript map
        $locationsForMap = $locations->map(function ($location) {
            return [
                'id' => $location->id,
                'name' => $location->name,
                'latitude' => (float) $location->latitude,
                'longitude' => (float) $location->longitude,
                'description' => $location->description
            ];
        });

        // Get active vehicles for the booking form
        $vehicles = Vehicle::active()
            ->orderBy('name')
            ->get()
            ->map(function ($vehicle) {
                return [
                    'id' => $vehicle->id,
                    'name' => $vehicle->name,
                    'type' => $vehicle->type,
                    'type_display' => ucfirst(str_replace('_', ' ', $vehicle->type)),
                    'pax_count' => $vehicle->pax_count,
                    'registration_number' => $vehicle->registration_number,
                    'driver_name' => $vehicle->driver_name,
                    'description' => $this->getVehicleDescription($vehicle),
                    'pricing_type' => $vehicle->pricing_type,
                    'per_km_price' => $vehicle->per_km_price,
                    'first_km_price' => $vehicle->first_km_price,
                    'per_100m_price' => $vehicle->per_100m_price
                ];
            });

        return view('home', compact('tourPackages', 'featuredReviews', 'locations', 'locationsForMap', 'vehicles'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function packages(Request $request)
    {
        $query = Package::with(['category', 'media'])->active()->ordered();
        
        // Filter by category if provided
        if ($request->has('category') && $request->category !== 'all') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        
        $packages = $query->get();
        $categories = PackageCategory::active()->ordered()->get();
        
        return view('packages', compact('packages', 'categories'));
    }

    public function packageDetails($slug)
    {
        $package = Package::with(['category', 'media'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Get related packages from the same category
        $relatedPackages = Package::with(['category', 'media'])
            ->where('package_category_id', $package->package_category_id)
            ->where('id', '!=', $package->id)
            ->where('is_active', true)
            ->limit(3)
            ->get();

        return view('package-details', compact('package', 'relatedPackages'));
    }

    /**
     * Get vehicle description
     */
    private function getVehicleDescription($vehicle)
    {
        $description = "{$vehicle->type_display} - {$vehicle->pax_count} passengers";
        
        if ($vehicle->driver_name) {
            $description .= " (Driver: {$vehicle->driver_name})";
        }
        
        if ($vehicle->registration_number) {
            $description .= " [{$vehicle->registration_number}]";
        }
        
        return $description;
    }
}
