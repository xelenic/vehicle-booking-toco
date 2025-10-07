@extends('layouts.admin')

@section('title', 'Edit Category')
@section('page-title', 'Edit Category')
@section('page-description', 'Update category information')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.categories') }}" class="text-blue-600 hover:text-blue-800 font-medium">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Categories
        </a>
    </div>

    <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Category Information</h3>
            
            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Category Name *</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea id="description" name="description" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="color" class="block text-sm font-medium text-gray-700 mb-2">Category Color *</label>
                    <div class="flex items-center space-x-4">
                        <input type="color" id="color" name="color" value="{{ old('color', $category->color) }}" required
                               class="w-12 h-12 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <input type="text" id="color-text" value="{{ old('color', $category->color) }}" readonly
                               class="w-24 px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-sm">
                    </div>
                    <p class="text-sm text-gray-500 mt-1">This color will be used for category badges and styling</p>
                    @error('color')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">Icon Class</label>
                    <div class="flex items-center space-x-4">
                        <input type="text" id="icon" name="icon" value="{{ old('icon', $category->icon) }}" placeholder="e.g., fas fa-mountain"
                               class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <div class="w-10 h-10 border border-gray-300 rounded-md flex items-center justify-center bg-gray-50">
                            <i id="icon-preview" class="{{ old('icon', $category->icon) }} text-gray-600"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">FontAwesome icon class (e.g., fas fa-mountain, fas fa-water, fas fa-camera)</p>
                    @error('icon')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-900">
                        Active Category (visible to customers)
                    </label>
                </div>
            </div>
        </div>

        <!-- Color Presets -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Color Presets</h3>
            <div class="grid grid-cols-6 gap-3">
                <button type="button" onclick="setColor('#3b82f6')" class="w-12 h-12 bg-blue-500 rounded-lg hover:scale-110 transition-transform duration-200" title="Blue"></button>
                <button type="button" onclick="setColor('#10b981')" class="w-12 h-12 bg-green-500 rounded-lg hover:scale-110 transition-transform duration-200" title="Green"></button>
                <button type="button" onclick="setColor('#f59e0b')" class="w-12 h-12 bg-yellow-500 rounded-lg hover:scale-110 transition-transform duration-200" title="Yellow"></button>
                <button type="button" onclick="setColor('#ef4444')" class="w-12 h-12 bg-red-500 rounded-lg hover:scale-110 transition-transform duration-200" title="Red"></button>
                <button type="button" onclick="setColor('#8b5cf6')" class="w-12 h-12 bg-purple-500 rounded-lg hover:scale-110 transition-transform duration-200" title="Purple"></button>
                <button type="button" onclick="setColor('#06b6d4')" class="w-12 h-12 bg-cyan-500 rounded-lg hover:scale-110 transition-transform duration-200" title="Cyan"></button>
            </div>
        </div>

        <!-- Icon Suggestions -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Icon Suggestions</h3>
            <div class="grid grid-cols-4 gap-3">
                <button type="button" onclick="setIcon('fas fa-mountain')" class="flex flex-col items-center p-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-mountain text-xl text-gray-600 mb-2"></i>
                    <span class="text-xs text-gray-600">Mountain</span>
                </button>
                <button type="button" onclick="setIcon('fas fa-water')" class="flex flex-col items-center p-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-water text-xl text-gray-600 mb-2"></i>
                    <span class="text-xs text-gray-600">Water</span>
                </button>
                <button type="button" onclick="setIcon('fas fa-camera')" class="flex flex-col items-center p-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-camera text-xl text-gray-600 mb-2"></i>
                    <span class="text-xs text-gray-600">Camera</span>
                </button>
                <button type="button" onclick="setIcon('fas fa-heart')" class="flex flex-col items-center p-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-heart text-xl text-gray-600 mb-2"></i>
                    <span class="text-xs text-gray-600">Heart</span>
                </button>
                <button type="button" onclick="setIcon('fas fa-leaf')" class="flex flex-col items-center p-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-leaf text-xl text-gray-600 mb-2"></i>
                    <span class="text-xs text-gray-600">Leaf</span>
                </button>
                <button type="button" onclick="setIcon('fas fa-sun')" class="flex flex-col items-center p-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-sun text-xl text-gray-600 mb-2"></i>
                    <span class="text-xs text-gray-600">Sun</span>
                </button>
                <button type="button" onclick="setIcon('fas fa-star')" class="flex flex-col items-center p-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-star text-xl text-gray-600 mb-2"></i>
                    <span class="text-xs text-gray-600">Star</span>
                </button>
                <button type="button" onclick="setIcon('fas fa-compass')" class="flex flex-col items-center p-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-compass text-xl text-gray-600 mb-2"></i>
                    <span class="text-xs text-gray-600">Compass</span>
                </button>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.categories') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg font-medium transition-colors duration-200">
                Cancel
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200">
                <i class="fas fa-save mr-2"></i>
                Update Category
            </button>
        </div>
    </form>
</div>

<script>
// Color picker functionality
document.getElementById('color').addEventListener('change', function() {
    document.getElementById('color-text').value = this.value;
});

function setColor(color) {
    document.getElementById('color').value = color;
    document.getElementById('color-text').value = color;
}

// Icon functionality
document.getElementById('icon').addEventListener('input', function() {
    const preview = document.getElementById('icon-preview');
    preview.className = this.value || 'fas fa-tag';
});

function setIcon(iconClass) {
    document.getElementById('icon').value = iconClass;
    document.getElementById('icon-preview').className = iconClass;
}
</script>
@endsection
