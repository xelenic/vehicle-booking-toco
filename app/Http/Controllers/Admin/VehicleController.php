<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Vehicle::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('registration_number', 'like', "%{$search}%")
                  ->orWhere('driver_name', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('model', 'like', "%{$search}%");
            });
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by active status
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        $vehicles = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'registration_number' => 'required|string|max:255|unique:vehicles',
            'type' => 'required|in:car,lorry,van,bus,jeep,tuk_tuk,motorcycle',
            'pax_count' => 'required|integer|min:1|max:100',
            'passenger_count' => 'required|integer|min:0',
            'first_1km_price' => 'required|numeric|min:0',
            'after_100m_price' => 'required|numeric|min:0',
            'available_locations' => 'required|array|min:1',
            'available_locations.*' => 'string|max:255',
            'driver_name' => 'nullable|string|max:255',
            'driver_phone' => 'nullable|string|max:20',
            'driver_license' => 'nullable|string|max:255',
            'manufacturing_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:100',
            'fuel_type' => 'nullable|in:petrol,diesel,hybrid,electric',
            'fuel_capacity' => 'nullable|numeric|min:0',
            'mileage' => 'nullable|numeric|min:0',
            'features' => 'nullable|array',
            'amenities' => 'nullable|array',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:available,busy,maintenance,out_of_service',
            'is_active' => 'boolean',
            'insurance_amount' => 'nullable|numeric|min:0',
            'insurance_expiry' => 'nullable|date',
            'maintenance_cost' => 'nullable|numeric|min:0',
            'last_maintenance_date' => 'nullable|date',
            'next_maintenance_date' => 'nullable|date',
            'notes' => 'nullable|string',
            'media_id' => 'nullable|exists:media,id',
        ]);

        $data = $request->all();

        // Handle media_id for image selection
        if ($request->has('media_id')) {
            $data['image'] = null; // Clear old image path since we're using media_id
        }

        // Ensure passenger count doesn't exceed pax count
        if ($data['passenger_count'] > $data['pax_count']) {
            $data['passenger_count'] = $data['pax_count'];
        }

        Vehicle::create($data);

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Vehicle created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        $vehicle->load('media');
        return view('admin.vehicles.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        $vehicle->load('media');
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'registration_number' => 'required|string|max:255|unique:vehicles,registration_number,' . $vehicle->id,
            'type' => 'required|in:car,lorry,van,bus,jeep,tuk_tuk,motorcycle',
            'pax_count' => 'required|integer|min:1|max:100',
            'passenger_count' => 'required|integer|min:0',
            'first_1km_price' => 'required|numeric|min:0',
            'after_100m_price' => 'required|numeric|min:0',
            'available_locations' => 'required|array|min:1',
            'available_locations.*' => 'string|max:255',
            'driver_name' => 'nullable|string|max:255',
            'driver_phone' => 'nullable|string|max:20',
            'driver_license' => 'nullable|string|max:255',
            'manufacturing_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:100',
            'fuel_type' => 'nullable|in:petrol,diesel,hybrid,electric',
            'fuel_capacity' => 'nullable|numeric|min:0',
            'mileage' => 'nullable|numeric|min:0',
            'features' => 'nullable|array',
            'amenities' => 'nullable|array',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:available,busy,maintenance,out_of_service',
            'is_active' => 'boolean',
            'insurance_amount' => 'nullable|numeric|min:0',
            'insurance_expiry' => 'nullable|date',
            'maintenance_cost' => 'nullable|numeric|min:0',
            'last_maintenance_date' => 'nullable|date',
            'next_maintenance_date' => 'nullable|date',
            'notes' => 'nullable|string',
            'media_id' => 'nullable|exists:media,id',
        ]);

        $data = $request->all();

        // Handle media_id for image selection
        if ($request->has('media_id')) {
            $data['image'] = null; // Clear old image path since we're using media_id
        }

        // Ensure passenger count doesn't exceed pax count
        if ($data['passenger_count'] > $data['pax_count']) {
            $data['passenger_count'] = $data['pax_count'];
        }

        $vehicle->update($data);

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Vehicle updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        // Delete images
        if ($vehicle->image) {
            Storage::disk('public')->delete($vehicle->image);
        }
        if ($vehicle->images) {
            foreach ($vehicle->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $vehicle->delete();

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Vehicle deleted successfully!');
    }

    /**
     * Toggle vehicle active status
     */
    public function toggleStatus(Vehicle $vehicle)
    {
        $vehicle->update(['is_active' => !$vehicle->is_active]);

        $status = $vehicle->is_active ? 'activated' : 'deactivated';
        return redirect()->back()
            ->with('success', "Vehicle {$status} successfully!");
    }

    /**
     * Update vehicle status
     */
    public function updateStatus(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'status' => 'required|in:available,busy,maintenance,out_of_service',
        ]);

        $vehicle->update(['status' => $request->status]);

        return redirect()->back()
            ->with('success', 'Vehicle status updated successfully!');
    }
}