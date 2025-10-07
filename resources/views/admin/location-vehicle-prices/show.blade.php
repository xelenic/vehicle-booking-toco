@extends('layouts.admin')

@section('title', 'View Location-Vehicle Price - Admin Panel')
@section('page-title', 'View Location-Vehicle Price')
@section('page-description', 'View details of a location-vehicle price')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-lg p-8">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <a href="{{ route('admin.location-vehicle-prices.index') }}" class="text-gray-500 hover:text-gray-700 mr-4">
                    <i class="fas fa-arrow-left text-xl"></i>
                </a>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Location-Vehicle Price Details</h2>
                    <p class="text-gray-600">View details of this pricing configuration</p>
                </div>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('admin.location-vehicle-prices.edit', $locationVehiclePrice) }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <form action="{{ route('admin.location-vehicle-prices.destroy', $locationVehiclePrice) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this price?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                        <i class="fas fa-trash mr-2"></i>Delete
                    </button>
                </form>
            </div>
        </div>

        <!-- Price Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <!-- Route Information -->
            <div class="bg-gray-50 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-route text-blue-600 mr-2"></i>
                    Route Information
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Pickup Location</label>
                        <div class="mt-1 text-lg font-semibold text-gray-900">{{ $locationVehiclePrice->pickupLocation->name }}</div>
                        <div class="text-sm text-gray-500">{{ $locationVehiclePrice->pickupLocation->formatted_coordinates }}</div>
                        <a href="{{ $locationVehiclePrice->pickupLocation->google_maps_url }}" target="_blank" class="text-xs text-blue-600 hover:text-blue-800">
                            <i class="fas fa-external-link-alt mr-1"></i>View on Map
                        </a>
                    </div>
                    <div class="flex items-center justify-center">
                        <i class="fas fa-arrow-down text-gray-400 text-xl"></i>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Destination Location</label>
                        <div class="mt-1 text-lg font-semibold text-gray-900">{{ $locationVehiclePrice->destinationLocation->name }}</div>
                        <div class="text-sm text-gray-500">{{ $locationVehiclePrice->destinationLocation->formatted_coordinates }}</div>
                        <a href="{{ $locationVehiclePrice->destinationLocation->google_maps_url }}" target="_blank" class="text-xs text-blue-600 hover:text-blue-800">
                            <i class="fas fa-external-link-alt mr-1"></i>View on Map
                        </a>
                    </div>
                </div>
            </div>

            <!-- Vehicle Information -->
            <div class="bg-gray-50 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-car text-purple-600 mr-2"></i>
                    Vehicle Information
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Vehicle Name</label>
                        <div class="mt-1 text-lg font-semibold text-gray-900">{{ $locationVehiclePrice->vehicle->name }}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Vehicle Type</label>
                        <div class="mt-1 text-sm text-gray-900">{{ ucfirst(str_replace('_', ' ', $locationVehiclePrice->vehicle->type)) }}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Passenger Capacity</label>
                        <div class="mt-1 text-sm text-gray-900">{{ $locationVehiclePrice->vehicle->pax_count }} passengers</div>
                    </div>
                    @if($locationVehiclePrice->vehicle->driver_name)
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Driver</label>
                        <div class="mt-1 text-sm text-gray-900">{{ $locationVehiclePrice->vehicle->driver_name }}</div>
                    </div>
                    @endif
                    @if($locationVehiclePrice->vehicle->registration_number)
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Registration Number</label>
                        <div class="mt-1 text-sm text-gray-900">{{ $locationVehiclePrice->vehicle->registration_number }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Price Details -->
        <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-xl p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-dollar-sign text-green-600 mr-2"></i>
                Price Information
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Price</label>
                    <div class="mt-1 text-3xl font-bold text-green-600">{{ $locationVehiclePrice->formatted_price }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <div class="mt-1">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $locationVehiclePrice->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $locationVehiclePrice->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Created</label>
                    <div class="mt-1 text-sm text-gray-900">{{ $locationVehiclePrice->created_at->format('M d, Y \a\t g:i A') }}</div>
                </div>
            </div>
        </div>

        <!-- Description -->
        @if($locationVehiclePrice->description)
        <div class="bg-gray-50 rounded-xl p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-align-left text-gray-600 mr-2"></i>
                Description
            </h3>
            <div class="text-gray-700 whitespace-pre-wrap">{{ $locationVehiclePrice->description }}</div>
        </div>
        @endif

        <!-- Actions -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
            <div class="flex space-x-2">
                <form action="{{ route('admin.location-vehicle-prices.toggle-status', $locationVehiclePrice) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" 
                            class="px-4 py-2 {{ $locationVehiclePrice->is_active ? 'bg-yellow-600 hover:bg-yellow-700' : 'bg-green-600 hover:bg-green-700' }} text-white rounded-lg font-medium transition-colors duration-200">
                        <i class="fas {{ $locationVehiclePrice->is_active ? 'fa-pause' : 'fa-play' }} mr-2"></i>
                        {{ $locationVehiclePrice->is_active ? 'Deactivate' : 'Activate' }}
                    </button>
                </form>
            </div>
            <div class="text-sm text-gray-500">
                Last updated: {{ $locationVehiclePrice->updated_at->format('M d, Y \a\t g:i A') }}
            </div>
        </div>
    </div>
</div>
@endsection

