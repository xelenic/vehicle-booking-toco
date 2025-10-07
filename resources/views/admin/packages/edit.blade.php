@extends('layouts.admin')

@section('title', 'Edit Package')
@section('page-title', 'Edit Package')
@section('page-description', 'Update package information')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.packages') }}" class="text-blue-600 hover:text-blue-800 font-medium">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Packages
        </a>
    </div>

    <form method="POST" action="{{ route('admin.packages.update', $package) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <!-- Basic Information -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Package Title *</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $package->title) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="package_category_id" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                    <select id="package_category_id" name="package_category_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('package_category_id', $package->package_category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('package_category_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">Duration *</label>
                    <input type="text" id="duration" name="duration" value="{{ old('duration', $package->duration) }}" placeholder="e.g., 3 Days / 2 Nights" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('duration')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="group_size" class="block text-sm font-medium text-gray-700 mb-2">Group Size *</label>
                    <input type="text" id="group_size" name="group_size" value="{{ old('group_size', $package->group_size) }}" placeholder="e.g., Max 12 people" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('group_size')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="difficulty" class="block text-sm font-medium text-gray-700 mb-2">Difficulty *</label>
                    <select id="difficulty" name="difficulty" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Select Difficulty</option>
                        <option value="Easy" {{ old('difficulty', $package->difficulty) == 'Easy' ? 'selected' : '' }}>Easy</option>
                        <option value="Moderate" {{ old('difficulty', $package->difficulty) == 'Moderate' ? 'selected' : '' }}>Moderate</option>
                        <option value="Hard" {{ old('difficulty', $package->difficulty) == 'Hard' ? 'selected' : '' }}>Hard</option>
                    </select>
                    @error('difficulty')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                <textarea id="description" name="description" rows="4" required
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('description', $package->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                <label for="short_description" class="block text-sm font-medium text-gray-700 mb-2">Short Description</label>
                <textarea id="short_description" name="short_description" rows="2"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('short_description', $package->short_description) }}</textarea>
                @error('short_description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Pricing -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Pricing</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price (USD) *</label>
                    <input type="number" id="price" name="price" value="{{ old('price', $package->price) }}" step="0.01" min="0" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="original_price" class="block text-sm font-medium text-gray-700 mb-2">Original Price (USD)</label>
                    <input type="number" id="original_price" name="original_price" value="{{ old('original_price', $package->original_price) }}" step="0.01" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('original_price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Image -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Package Image</h3>
            
            <!-- Media Manager Integration -->
            <div id="media-preview" class="mb-4">
                @if($package->media)
                    <div class="relative group">
                        <div class="aspect-video bg-gray-100 rounded-lg overflow-hidden">
                            <img src="{{ $package->media->url }}" alt="{{ $package->media->name }}" class="w-full h-full object-cover">
                        </div>
                        <button type="button" onclick="removeSelectedImage()" 
                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <i class="fas fa-times"></i>
                        </button>
                        <div class="mt-2">
                            <p class="text-sm font-medium text-gray-900">{{ $package->media->name }}</p>
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
                    <i class="fas fa-images mr-2"></i>{{ $package->media ? 'Change Image' : 'Choose Image' }}
                </button>
            </div>
            
            <!-- Hidden inputs -->
            <input type="hidden" id="media-input" name="media_id" value="{{ old('media_id', $package->media_id) }}">
            
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            @error('media_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Highlights -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Package Highlights</h3>
            
            <div id="highlights-container">
                @php
                    $highlights = old('highlights', []);
                    if (empty($highlights) && $package->highlights) {
                        // Check if highlights is already an array or needs to be decoded
                        if (is_string($package->highlights)) {
                            $highlights = json_decode($package->highlights, true) ?: [];
                        } elseif (is_array($package->highlights)) {
                            $highlights = $package->highlights;
                        }
                    }
                    if (empty($highlights)) {
                        $highlights = [''];
                    }
                @endphp
                
                @foreach($highlights as $index => $highlight)
                <div class="flex items-center space-x-2 mb-2">
                    <input type="text" name="highlights[]" placeholder="Enter a highlight" value="{{ $highlight }}"
                           class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @if($index == 0)
                        <button type="button" onclick="addHighlight()" class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-md">
                            <i class="fas fa-plus"></i>
                        </button>
                    @else
                        <button type="button" onclick="removeHighlight(this)" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-md">
                            <i class="fas fa-trash"></i>
                        </button>
                    @endif
                </div>
                @endforeach
            </div>
            @error('highlights')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Additional Information -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Additional Information</h3>
            
            <div class="space-y-6">
                <div>
                    <label for="included" class="block text-sm font-medium text-gray-700 mb-2">What's Included</label>
                    <textarea id="included" name="included" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('included', $package->included) }}</textarea>
                    @error('included')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="not_included" class="block text-sm font-medium text-gray-700 mb-2">What's Not Included</label>
                    <textarea id="not_included" name="not_included" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('not_included', $package->not_included) }}</textarea>
                    @error('not_included')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="itinerary" class="block text-sm font-medium text-gray-700 mb-2">Itinerary</label>
                    <textarea id="itinerary" name="itinerary" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('itinerary', $package->itinerary) }}</textarea>
                    @error('itinerary')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="requirements" class="block text-sm font-medium text-gray-700 mb-2">Requirements</label>
                    <textarea id="requirements" name="requirements" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('requirements', $package->requirements) }}</textarea>
                    @error('requirements')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="cancellation_policy" class="block text-sm font-medium text-gray-700 mb-2">Cancellation Policy</label>
                    <textarea id="cancellation_policy" name="cancellation_policy" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('cancellation_policy', $package->cancellation_policy) }}</textarea>
                    @error('cancellation_policy')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Settings -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Package Settings</h3>
            
            <div class="space-y-4">
                <div class="flex items-center">
                    <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $package->is_featured) ? 'checked' : '' }}
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_featured" class="ml-2 block text-sm text-gray-900">
                        Featured Package (will appear on homepage)
                    </label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $package->is_active) ? 'checked' : '' }}
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-900">
                        Active Package (visible to customers)
                    </label>
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.packages') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg font-medium transition-colors duration-200">
                Cancel
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200">
                <i class="fas fa-save mr-2"></i>
                Update Package
            </button>
        </div>
    </form>
</div>

<script>
// Media Manager Integration
let selectedMedia = @json($package->media);

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
    document.getElementById('media-input').value = '';
    document.getElementById('media-preview').innerHTML = `
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
            <i class="fas fa-image text-4xl text-gray-300 mb-2"></i>
            <p class="text-gray-500">No image selected</p>
        </div>
    `;
}

function addHighlight() {
    const container = document.getElementById('highlights-container');
    const div = document.createElement('div');
    div.className = 'flex items-center space-x-2 mb-2';
    div.innerHTML = `
        <input type="text" name="highlights[]" placeholder="Enter a highlight"
               class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        <button type="button" onclick="removeHighlight(this)" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-md">
            <i class="fas fa-trash"></i>
        </button>
    `;
    container.appendChild(div);
}

function removeHighlight(button) {
    button.parentElement.remove();
}
</script>
@endsection
