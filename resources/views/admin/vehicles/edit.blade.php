@extends('layouts.admin')

@section('title', 'Edit Vehicle - Admin Panel')
@section('page-title', 'Edit Vehicle')
@section('page-description', 'Edit vehicle information')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.vehicles.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Vehicles
        </a>
    </div>

    <form method="POST" action="{{ route('admin.vehicles.update', $vehicle) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <!-- Basic Information -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Vehicle Name *</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $vehicle->name) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="registration_number" class="block text-sm font-medium text-gray-700 mb-2">Registration Number *</label>
                    <input type="text" id="registration_number" name="registration_number" value="{{ old('registration_number', $vehicle->registration_number) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('registration_number')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Vehicle Type *</label>
                    <select id="type" name="type" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Select Type</option>
                        <option value="car" {{ old('type', $vehicle->type) == 'car' ? 'selected' : '' }}>Car</option>
                        <option value="van" {{ old('type', $vehicle->type) == 'van' ? 'selected' : '' }}>Van</option>
                        <option value="bus" {{ old('type', $vehicle->type) == 'bus' ? 'selected' : '' }}>Bus</option>
                        <option value="jeep" {{ old('type', $vehicle->type) == 'jeep' ? 'selected' : '' }}>Jeep</option>
                        <option value="lorry" {{ old('type', $vehicle->type) == 'lorry' ? 'selected' : '' }}>Lorry</option>
                        <option value="tuk_tuk" {{ old('type', $vehicle->type) == 'tuk_tuk' ? 'selected' : '' }}>Tuk Tuk</option>
                        <option value="motorcycle" {{ old('type', $vehicle->type) == 'motorcycle' ? 'selected' : '' }}>Motorcycle</option>
                    </select>
                    @error('type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="brand" class="block text-sm font-medium text-gray-700 mb-2">Brand</label>
                    <input type="text" id="brand" name="brand" value="{{ old('brand', $vehicle->brand) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('brand')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="model" class="block text-sm font-medium text-gray-700 mb-2">Model</label>
                    <input type="text" id="model" name="model" value="{{ old('model', $vehicle->model) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('model')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="color" class="block text-sm font-medium text-gray-700 mb-2">Color</label>
                    <input type="text" id="color" name="color" value="{{ old('color', $vehicle->color) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('color')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="manufacturing_year" class="block text-sm font-medium text-gray-700 mb-2">Manufacturing Year</label>
                    <input type="number" id="manufacturing_year" name="manufacturing_year" value="{{ old('manufacturing_year', $vehicle->manufacturing_year) }}" min="1900" max="{{ date('Y') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('manufacturing_year')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Capacity & Pricing -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Capacity & Pricing</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="pax_count" class="block text-sm font-medium text-gray-700 mb-2">Maximum PAX Count *</label>
                    <input type="number" id="pax_count" name="pax_count" value="{{ old('pax_count', $vehicle->pax_count) }}" required min="1"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('pax_count')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="passenger_count" class="block text-sm font-medium text-gray-700 mb-2">Current Passenger Count</label>
                    <input type="number" id="passenger_count" name="passenger_count" value="{{ old('passenger_count', $vehicle->passenger_count) }}" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('passenger_count')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="price_first_km" class="block text-sm font-medium text-gray-700 mb-2">Price for First 1km (LKR) *</label>
                    <input type="number" id="price_first_km" name="price_first_km" value="{{ old('price_first_km', $vehicle->price_first_km) }}" required step="0.01" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('price_first_km')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="price_per_100m_after" class="block text-sm font-medium text-gray-700 mb-2">Price per 100m After (LKR) *</label>
                    <input type="number" id="price_per_100m_after" name="price_per_100m_after" value="{{ old('price_per_100m_after', $vehicle->price_per_100m_after) }}" required step="0.01" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('price_per_100m_after')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Driver Information -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Driver Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="driver_name" class="block text-sm font-medium text-gray-700 mb-2">Driver Name</label>
                    <input type="text" id="driver_name" name="driver_name" value="{{ old('driver_name', $vehicle->driver_name) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('driver_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="driver_phone" class="block text-sm font-medium text-gray-700 mb-2">Driver Phone</label>
                    <input type="text" id="driver_phone" name="driver_phone" value="{{ old('driver_phone', $vehicle->driver_phone) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('driver_phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="md:col-span-2">
                    <label for="driver_license_number" class="block text-sm font-medium text-gray-700 mb-2">Driver License Number</label>
                    <input type="text" id="driver_license_number" name="driver_license_number" value="{{ old('driver_license_number', $vehicle->driver_license_number) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('driver_license_number')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Vehicle Details -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Vehicle Details</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="fuel_type" class="block text-sm font-medium text-gray-700 mb-2">Fuel Type</label>
                    <select id="fuel_type" name="fuel_type"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Select Fuel Type</option>
                        <option value="Petrol" {{ old('fuel_type', $vehicle->fuel_type) == 'Petrol' ? 'selected' : '' }}>Petrol</option>
                        <option value="Diesel" {{ old('fuel_type', $vehicle->fuel_type) == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                        <option value="Electric" {{ old('fuel_type', $vehicle->fuel_type) == 'Electric' ? 'selected' : '' }}>Electric</option>
                        <option value="Hybrid" {{ old('fuel_type', $vehicle->fuel_type) == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                    </select>
                    @error('fuel_type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="fuel_capacity" class="block text-sm font-medium text-gray-700 mb-2">Fuel Capacity (Liters)</label>
                    <input type="number" id="fuel_capacity" name="fuel_capacity" value="{{ old('fuel_capacity', $vehicle->fuel_capacity) }}" step="0.01" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('fuel_capacity')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="mileage" class="block text-sm font-medium text-gray-700 mb-2">Mileage (km/L)</label>
                    <input type="number" id="mileage" name="mileage" value="{{ old('mileage', $vehicle->mileage) }}" step="0.01" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('mileage')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select id="status" name="status" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="available" {{ old('status', $vehicle->status) == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="busy" {{ old('status', $vehicle->status) == 'busy' ? 'selected' : '' }}>Busy</option>
                        <option value="maintenance" {{ old('status', $vehicle->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                        <option value="out_of_service" {{ old('status', $vehicle->status) == 'out_of_service' ? 'selected' : '' }}>Out of Service</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Available Locations -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Available Locations</h3>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @php
                    $locations = ['Colombo', 'Kandy', 'Galle', 'Mirissa', 'Ella', 'Sigiriya', 'Anuradhapura', 'Polonnaruwa', 'Negombo', 'Bentota', 'Hikkaduwa', 'Unawatuna'];
                    $selectedLocations = old('available_locations', $vehicle->available_locations ?? []);
                @endphp
                
                @foreach($locations as $location)
                <label class="flex items-center">
                    <input type="checkbox" name="available_locations[]" value="{{ $location }}" 
                           {{ in_array($location, $selectedLocations) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm text-gray-700">{{ $location }}</span>
                </label>
                @endforeach
            </div>
            @error('available_locations')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Features & Amenities -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Features & Amenities</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Features</label>
                    <div class="space-y-2">
                        @php
                            $features = ['AC', 'WiFi', 'GPS', 'Music System', 'Comfort Seats', 'Luggage Space', 'USB Charging', 'Bluetooth'];
                            $selectedFeatures = old('features', $vehicle->features ?? []);
                        @endphp
                        
                        @foreach($features as $feature)
                        <label class="flex items-center">
                            <input type="checkbox" name="features[]" value="{{ $feature }}" 
                                   {{ in_array($feature, $selectedFeatures) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">{{ $feature }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Amenities</label>
                    <div class="space-y-2">
                        @php
                            $amenities = ['Child Seat', 'Roof Rack', 'Cooler Box', 'First Aid Kit', 'Umbrella', 'Water Bottles', 'Snacks', 'Tour Guide'];
                            $selectedAmenities = old('amenities', $vehicle->amenities ?? []);
                        @endphp
                        
                        @foreach($amenities as $amenity)
                        <label class="flex items-center">
                            <input type="checkbox" name="amenities[]" value="{{ $amenity }}" 
                                   {{ in_array($amenity, $selectedAmenities) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">{{ $amenity }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Images -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Vehicle Image</h3>
            
            <!-- Media Manager Integration -->
            <div id="media-preview" class="mb-4">
                @if($vehicle->media)
                    <div class="relative group">
                        <div class="aspect-video bg-gray-100 rounded-lg overflow-hidden">
                            <img src="{{ $vehicle->media->url }}" alt="{{ $vehicle->media->name }}" class="w-full h-full object-cover">
                        </div>
                        <button type="button" onclick="removeSelectedImage()" 
                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <i class="fas fa-times"></i>
                        </button>
                        <div class="mt-2">
                            <p class="text-sm font-medium text-gray-900">{{ $vehicle->media->name }}</p>
                        </div>
                    </div>
                @else
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                        <i class="fas fa-image text-4xl text-gray-300 mb-2"></i>
                        <p class="text-gray-500">No image selected</p>
                    </div>
                @endif
            </div>
            
            <div class="text-center">
                <button type="button" id="open-media-manager-btn" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                    <i class="fas fa-images mr-2"></i>{{ $vehicle->media ? 'Change Image' : 'Choose Image' }}
                </button>
            </div>
            
            <!-- Hidden inputs -->
            <input type="hidden" id="media-input" name="media_id" value="{{ old('media_id', $vehicle->media_id) }}">
            
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            @error('media_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Description</h3>
            
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Vehicle Description</label>
                <textarea id="description" name="description" rows="4"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('description', $vehicle->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Actions -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.vehicles.index') }}" class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Update Vehicle
            </button>
        </div>
    </form>
</div>

<script>
let selectedMedia = @json($vehicle->media);

document.addEventListener('DOMContentLoaded', function() {
    // Open media manager button
    document.getElementById('open-media-manager-btn').addEventListener('click', function() {
        if (typeof window.openMediaManager === 'function') {
            window.openMediaManager(function(media) {
                selectedMedia = media;
                updatePreview(media);
                updateHiddenInput(media);
            });
        } else {
            console.error('Media manager modal not available');
        }
    });
});

function updatePreview(media) {
    const preview = document.getElementById('media-preview');
    preview.innerHTML = `
        <div class="relative group">
            <div class="aspect-video bg-gray-100 rounded-lg overflow-hidden">
                <img src="${media.url}" alt="${media.name}" class="w-full h-full object-cover">
            </div>
            <button type="button" onclick="removeSelectedImage()" 
                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                <i class="fas fa-times"></i>
            </button>
            <div class="mt-2">
                <p class="text-sm font-medium text-gray-900">${media.name}</p>
            </div>
        </div>
    `;
}

function updateHiddenInput(media) {
    document.getElementById('media-input').value = media.id;
}

function removeSelectedImage() {
    selectedMedia = null;
    document.getElementById('media-preview').innerHTML = `
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
            <i class="fas fa-image text-4xl text-gray-300 mb-2"></i>
            <p class="text-gray-500">No image selected</p>
        </div>
    `;
    document.getElementById('media-input').value = '';
}

// Auto-update passenger count when pax count changes
document.getElementById('pax_count').addEventListener('input', function() {
    const paxCount = parseInt(this.value);
    const passengerCount = document.getElementById('passenger_count');
    if (passengerCount.value > paxCount) {
        passengerCount.value = paxCount;
    }
    passengerCount.max = paxCount;
});
</script>
@endsection