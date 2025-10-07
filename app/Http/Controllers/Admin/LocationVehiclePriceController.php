<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LocationVehiclePrice;
use App\Models\Location;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class LocationVehiclePriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = LocationVehiclePrice::with(['pickupLocation', 'destinationLocation', 'vehicle']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('pickupLocation', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('destinationLocation', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('vehicle', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhere('description', 'like', "%{$search}%");
        }

        // Filter by active status
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        // Filter by pickup location
        if ($request->filled('pickup_location_id')) {
            $query->where('pickup_location_id', $request->pickup_location_id);
        }

        // Filter by destination location
        if ($request->filled('destination_location_id')) {
            $query->where('destination_location_id', $request->destination_location_id);
        }

        // Filter by vehicle
        if ($request->filled('vehicle_id')) {
            $query->where('vehicle_id', $request->vehicle_id);
        }

        $prices = $query->orderBy('created_at', 'desc')->paginate(15);
        $locations = Location::active()->orderBy('name')->get();
        $vehicles = Vehicle::active()->orderBy('name')->get();

        return view('admin.location-vehicle-prices.index', compact('prices', 'locations', 'vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::active()->orderBy('name')->get();
        $vehicles = Vehicle::active()->orderBy('name')->get();
        
        return view('admin.location-vehicle-prices.create', compact('locations', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pickup_location_id' => 'required|exists:locations,id',
            'destination_location_id' => 'required|exists:locations,id|different:pickup_location_id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'is_active' => 'boolean',
        ], [
            'destination_location_id.different' => 'Destination must be different from pickup location.',
        ]);

        // Check if combination already exists
        $existingPrice = LocationVehiclePrice::where([
            'pickup_location_id' => $request->pickup_location_id,
            'destination_location_id' => $request->destination_location_id,
            'vehicle_id' => $request->vehicle_id,
        ])->first();

        if ($existingPrice) {
            return redirect()->back()
                ->withErrors(['error' => 'A price for this route and vehicle combination already exists.'])
                ->withInput();
        }

        LocationVehiclePrice::create($request->all());

        return redirect()->route('admin.location-vehicle-prices.index')
            ->with('success', 'Location-Vehicle price created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(LocationVehiclePrice $locationVehiclePrice)
    {
        $locationVehiclePrice->load(['pickupLocation', 'destinationLocation', 'vehicle']);
        return view('admin.location-vehicle-prices.show', compact('locationVehiclePrice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LocationVehiclePrice $locationVehiclePrice)
    {
        $locations = Location::active()->orderBy('name')->get();
        $vehicles = Vehicle::active()->orderBy('name')->get();
        
        return view('admin.location-vehicle-prices.edit', compact('locationVehiclePrice', 'locations', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LocationVehiclePrice $locationVehiclePrice)
    {
        $request->validate([
            'pickup_location_id' => 'required|exists:locations,id',
            'destination_location_id' => 'required|exists:locations,id|different:pickup_location_id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'is_active' => 'boolean',
        ], [
            'destination_location_id.different' => 'Destination must be different from pickup location.',
        ]);

        // Check if combination already exists (excluding current record)
        $existingPrice = LocationVehiclePrice::where([
            'pickup_location_id' => $request->pickup_location_id,
            'destination_location_id' => $request->destination_location_id,
            'vehicle_id' => $request->vehicle_id,
        ])->where('id', '!=', $locationVehiclePrice->id)->first();

        if ($existingPrice) {
            return redirect()->back()
                ->withErrors(['error' => 'A price for this route and vehicle combination already exists.'])
                ->withInput();
        }

        $locationVehiclePrice->update($request->all());

        return redirect()->route('admin.location-vehicle-prices.index')
            ->with('success', 'Location-Vehicle price updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LocationVehiclePrice $locationVehiclePrice)
    {
        $locationVehiclePrice->delete();

        return redirect()->route('admin.location-vehicle-prices.index')
            ->with('success', 'Location-Vehicle price deleted successfully!');
    }

    /**
     * Toggle price active status
     */
    public function toggleStatus(LocationVehiclePrice $locationVehiclePrice)
    {
        $locationVehiclePrice->update(['is_active' => !$locationVehiclePrice->is_active]);

        $status = $locationVehiclePrice->is_active ? 'activated' : 'deactivated';
        return redirect()->back()
            ->with('success', "Location-Vehicle price {$status} successfully!");
    }
}
