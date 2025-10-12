@extends('layouts.admin')

@section('title', 'Vehicle Management - Admin Panel')
@section('page-title', 'Vehicle Management')
@section('page-description', 'Manage your vehicle fleet')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Vehicle Management</h2>
        <p class="text-gray-600">Create, edit, and manage your vehicle fleet</p>
    </div>
    <a href="{{ route('admin.vehicles.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
        <i class="fas fa-plus mr-2"></i>
        Add New Vehicle
    </a>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-4">
                <i class="fas fa-car text-blue-600 text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-600">Total Vehicles</p>
                <p class="text-2xl font-bold text-gray-900">{{ $vehicles->total() }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-4">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-600">Available</p>
                <p class="text-2xl font-bold text-gray-900">{{ $vehicles->where('status', 'available')->count() }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center mr-4">
                <i class="fas fa-tools text-yellow-600 text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-600">In Maintenance</p>
                <p class="text-2xl font-bold text-gray-900">{{ $vehicles->where('status', 'maintenance')->count() }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mr-4">
                <i class="fas fa-users text-purple-600 text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-600">Total Capacity</p>
                <p class="text-2xl font-bold text-gray-900">{{ $vehicles->sum('pax_count') }}</p>
            </div>
        </div>
    </div>
</div>

@if($vehicles->count() > 0)
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vehicle</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Capacity</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pricing</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Driver</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($vehicles as $vehicle)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-12 w-12">
                                <img class="h-12 w-12 rounded-lg object-cover" src="{{ $vehicle->image_url }}" alt="{{ $vehicle->name }}">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $vehicle->name }}</div>
                                <div class="text-sm text-gray-500">{{ $vehicle->registration_number }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ ucfirst($vehicle->type) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <div class="font-medium">{{ $vehicle->pax_count }} PAX</div>
                        <div class="text-xs text-gray-500">{{ $vehicle->passenger_count }} current</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        @if($vehicle->pricing_type === 'standard')
                            <div class="font-medium">{{ $vehicle->formatted_per_km_price }}</div>
                            <div class="text-xs text-gray-500">per 1km</div>
                        @elseif($vehicle->pricing_type === 'first_km_meter')
                            <div class="font-medium">{{ $vehicle->formatted_first_km_price }}</div>
                            <div class="text-xs text-gray-500">+ {{ $vehicle->formatted_per_100m_price }}/100m</div>
                        @else
                            <div class="font-medium">{{ $vehicle->formatted_price_first_km }}</div>
                            <div class="text-xs text-gray-500">+ {{ $vehicle->formatted_price_per_100m_after }}/100m</div>
                        @endif
                        <div class="text-xs text-blue-600 mt-1">{{ $vehicle->pricing_type_label }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $vehicle->status_badge }}">
                            {{ ucfirst(str_replace('_', ' ', $vehicle->status)) }}
                        </span>
                        @if(!$vehicle->is_active)
                            <br><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 mt-1">
                                Inactive
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        @if($vehicle->driver_name)
                            <div class="font-medium">{{ $vehicle->driver_name }}</div>
                            <div class="text-xs text-gray-500">{{ $vehicle->driver_phone }}</div>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $vehicle->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="{{ route('admin.vehicles.show', $vehicle) }}" class="text-blue-600 hover:text-blue-900" title="View Vehicle">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="text-indigo-600 hover:text-indigo-900" title="Edit Vehicle">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.vehicles.toggle-status', $vehicle) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-{{ $vehicle->is_active ? 'yellow' : 'green' }}-600 hover:text-{{ $vehicle->is_active ? 'yellow' : 'green' }}-900" title="{{ $vehicle->is_active ? 'Deactivate' : 'Activate' }}">
                                    <i class="fas fa-{{ $vehicle->is_active ? 'pause' : 'play' }}"></i>
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.vehicles.destroy', $vehicle) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this vehicle?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" title="Delete Vehicle">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $vehicles->links() }}
    </div>
</div>
@else
<div class="bg-white rounded-lg shadow-md p-12 text-center">
    <i class="fas fa-car text-gray-400 text-6xl mb-4"></i>
    <h3 class="text-lg font-medium text-gray-900 mb-2">No vehicles found</h3>
    <p class="text-gray-600 mb-6">Get started by adding your first vehicle to the fleet.</p>
    <a href="{{ route('admin.vehicles.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
        <i class="fas fa-plus mr-2"></i>
        Add Your First Vehicle
    </a>
</div>
@endif
@endsection