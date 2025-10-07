@extends('layouts.admin')

@section('title', 'Location-Vehicle Price Management - Admin Panel')
@section('page-title', 'Location-Vehicle Price Management')
@section('page-description', 'Manage pricing for routes and vehicles')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Location-Vehicle Price Management</h2>
        <p class="text-gray-600">Create, edit, and manage pricing for routes and vehicles</p>
    </div>
    <a href="{{ route('admin.location-vehicle-prices.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
        <i class="fas fa-plus mr-2"></i>
        Add New Price
    </a>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-4">
                <i class="fas fa-route text-blue-600 text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-600">Total Prices</p>
                <p class="text-2xl font-bold text-gray-900">{{ $prices->total() }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-4">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-600">Active</p>
                <p class="text-2xl font-bold text-gray-900">{{ $prices->where('is_active', true)->count() }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center mr-4">
                <i class="fas fa-pause-circle text-gray-600 text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-600">Inactive</p>
                <p class="text-2xl font-bold text-gray-900">{{ $prices->where('is_active', false)->count() }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mr-4">
                <i class="fas fa-car text-purple-600 text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-600">Unique Routes</p>
                <p class="text-2xl font-bold text-gray-900">{{ $prices->unique(function($item) { return $item->pickup_location_id . '-' . $item->destination_location_id; })->count() }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
    <form method="GET" class="flex flex-wrap gap-4 items-end">
        <div class="flex-1 min-w-64">
            <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search</label>
            <input type="text" id="search" name="search" value="{{ request('search') }}" 
                   placeholder="Search by location, vehicle, or description..." 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>
        <div class="min-w-48">
            <label for="pickup_location_id" class="block text-sm font-medium text-gray-700 mb-2">Pickup Location</label>
            <select id="pickup_location_id" name="pickup_location_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">All Pickup Locations</option>
                @foreach($locations as $location)
                    <option value="{{ $location->id }}" {{ request('pickup_location_id') == $location->id ? 'selected' : '' }}>
                        {{ $location->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="min-w-48">
            <label for="destination_location_id" class="block text-sm font-medium text-gray-700 mb-2">Destination</label>
            <select id="destination_location_id" name="destination_location_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">All Destinations</option>
                @foreach($locations as $location)
                    <option value="{{ $location->id }}" {{ request('destination_location_id') == $location->id ? 'selected' : '' }}>
                        {{ $location->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="min-w-48">
            <label for="vehicle_id" class="block text-sm font-medium text-gray-700 mb-2">Vehicle</label>
            <select id="vehicle_id" name="vehicle_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">All Vehicles</option>
                @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}" {{ request('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                        {{ $vehicle->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="min-w-48">
            <label for="is_active" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <select id="is_active" name="is_active" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">All Status</option>
                <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200">
                <i class="fas fa-search mr-2"></i>Filter
            </button>
            <a href="{{ route('admin.location-vehicle-prices.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200">
                <i class="fas fa-times mr-2"></i>Clear
            </a>
        </div>
    </form>
</div>

<!-- Prices Table -->
<div class="bg-white rounded-2xl shadow-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Route</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vehicle</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($prices as $price)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div>
                            <div class="text-sm font-medium text-gray-900">
                                {{ $price->pickupLocation->name }} → {{ $price->destinationLocation->name }}
                            </div>
                            @if($price->description)
                            <div class="text-sm text-gray-500">{{ Str::limit($price->description, 50) }}</div>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $price->vehicle->name }}</div>
                        <div class="text-sm text-gray-500">{{ ucfirst(str_replace('_', ' ', $price->vehicle->type)) }} - {{ $price->vehicle->pax_count }} pax</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-lg font-bold text-green-600">{{ $price->formatted_price }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $price->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $price->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $price->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="{{ route('admin.location-vehicle-prices.show', $price) }}" class="text-blue-600 hover:text-blue-900" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.location-vehicle-prices.edit', $price) }}" class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.location-vehicle-prices.toggle-status', $price) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-yellow-600 hover:text-yellow-900" title="{{ $price->is_active ? 'Deactivate' : 'Activate' }}">
                                    <i class="fas {{ $price->is_active ? 'fa-pause' : 'fa-play' }}"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.location-vehicle-prices.destroy', $price) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this price?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="text-gray-500">
                            <i class="fas fa-route text-4xl mb-4"></i>
                            <p class="text-lg font-medium">No prices found</p>
                            <p class="text-sm">Get started by creating your first location-vehicle price.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($prices->hasPages())
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
        {{ $prices->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection

