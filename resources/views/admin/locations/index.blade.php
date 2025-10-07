@extends('layouts.admin')

@section('title', 'Location Management - Admin Panel')
@section('page-title', 'Location Management')
@section('page-description', 'Manage your locations')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Location Management</h2>
        <p class="text-gray-600">Create, edit, and manage your locations</p>
    </div>
    <a href="{{ route('admin.locations.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
        <i class="fas fa-plus mr-2"></i>
        Add New Location
    </a>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-4">
                <i class="fas fa-map-marker-alt text-blue-600 text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-600">Total Locations</p>
                <p class="text-2xl font-bold text-gray-900">{{ $locations->total() }}</p>
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
                <p class="text-2xl font-bold text-gray-900">{{ $locations->where('is_active', true)->count() }}</p>
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
                <p class="text-2xl font-bold text-gray-900">{{ $locations->where('is_active', false)->count() }}</p>
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
                   placeholder="Search by name or description..." 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
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
            <a href="{{ route('admin.locations.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200">
                <i class="fas fa-times mr-2"></i>Clear
            </a>
        </div>
    </form>
</div>

<!-- Locations Table -->
<div class="bg-white rounded-2xl shadow-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Coordinates</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($locations as $location)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div>
                            <div class="text-sm font-medium text-gray-900">{{ $location->name }}</div>
                            @if($location->description)
                            <div class="text-sm text-gray-500">{{ Str::limit($location->description, 50) }}</div>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $location->formatted_coordinates }}</div>
                        <a href="{{ $location->google_maps_url }}" target="_blank" class="text-xs text-blue-600 hover:text-blue-800">
                            <i class="fas fa-external-link-alt mr-1"></i>View on Map
                        </a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $location->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $location->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $location->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="{{ route('admin.locations.show', $location) }}" class="text-blue-600 hover:text-blue-900" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.locations.edit', $location) }}" class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.locations.toggle-status', $location) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-yellow-600 hover:text-yellow-900" title="{{ $location->is_active ? 'Deactivate' : 'Activate' }}">
                                    <i class="fas {{ $location->is_active ? 'fa-pause' : 'fa-play' }}"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.locations.destroy', $location) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this location?')">
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
                    <td colspan="5" class="px-6 py-12 text-center">
                        <div class="text-gray-500">
                            <i class="fas fa-map-marker-alt text-4xl mb-4"></i>
                            <p class="text-lg font-medium">No locations found</p>
                            <p class="text-sm">Get started by creating your first location.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($locations->hasPages())
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
        {{ $locations->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection

