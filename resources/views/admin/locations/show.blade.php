@extends('layouts.admin')

@section('title', 'View Location - Admin Panel')
@section('page-title', 'View Location')
@section('page-description', 'Location details and information')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-lg p-8 mb-6">
        <div class="flex justify-between items-start">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">{{ $location->name }}</h2>
                <p class="text-gray-600 mt-1">{{ $location->formatted_coordinates }}</p>
                @if($location->description)
                <p class="text-gray-700 mt-2">{{ $location->description }}</p>
                @endif
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.locations.edit', $location) }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <a href="{{ route('admin.locations.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Back
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Location Details -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Location Details</h3>
            <div class="space-y-4">
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-600">Name</span>
                    <span class="text-sm text-gray-900">{{ $location->name }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-600">Latitude</span>
                    <span class="text-sm text-gray-900">{{ $location->latitude }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-600">Longitude</span>
                    <span class="text-sm text-gray-900">{{ $location->longitude }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-600">Status</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $location->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $location->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-600">Created</span>
                    <span class="text-sm text-gray-900">{{ $location->created_at->format('M d, Y g:i A') }}</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-sm font-medium text-gray-600">Last Updated</span>
                    <span class="text-sm text-gray-900">{{ $location->updated_at->format('M d, Y g:i A') }}</span>
                </div>
            </div>
        </div>

        <!-- Map -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Location on Map</h3>
            <div class="w-full h-64 bg-gray-100 rounded-lg overflow-hidden">
                <iframe 
                    width="100%" 
                    height="100%" 
                    frameborder="0" 
                    style="border:0;"
                    src="https://www.google.com/maps/embed/v1/view?key=AIzaSyBFw0Qbyq9zTFTd-tUY6dOWWgHjJ5w1B1Y&center={{ $location->latitude }},{{ $location->longitude }}&zoom=15&maptype=roadmap"
                    allowfullscreen>
                </iframe>
            </div>
            <div class="mt-4 flex justify-center">
                <a href="{{ $location->google_maps_url }}" target="_blank" 
                   class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    <i class="fas fa-external-link-alt mr-1"></i>Open in Google Maps
                </a>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mt-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions</h3>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.locations.edit', $location) }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                <i class="fas fa-edit mr-2"></i>Edit Location
            </a>
            
            <form action="{{ route('admin.locations.toggle-status', $location) }}" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <button type="submit" 
                        class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                    <i class="fas {{ $location->is_active ? 'fa-pause' : 'fa-play' }} mr-2"></i>
                    {{ $location->is_active ? 'Deactivate' : 'Activate' }}
                </button>
            </form>
            
            <form action="{{ route('admin.locations.destroy', $location) }}" method="POST" class="inline" 
                  onsubmit="return confirm('Are you sure you want to delete this location? This action cannot be undone.')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                    <i class="fas fa-trash mr-2"></i>Delete Location
                </button>
            </form>
            
            <a href="{{ route('admin.locations.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Locations
            </a>
        </div>
    </div>
</div>
@endsection

