@extends('layouts.admin')

@section('title', 'Edit Setting')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Setting</h1>
                    <p class="mt-2 text-gray-600">Update setting: {{ $setting->label }}</p>
                </div>
                <a href="{{ route('admin.settings.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Settings
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form action="{{ route('admin.settings.update-setting', $setting) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Key -->
                <div>
                    <label for="key" class="block text-sm font-semibold text-gray-700 mb-2">Setting Key *</label>
                    <input type="text" id="key" name="key" value="{{ old('key', $setting->key) }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('key') border-red-500 @enderror"
                           placeholder="e.g., site_name, contact_email">
                    @error('key')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-sm text-gray-500 mt-1">Unique identifier for this setting (lowercase, use underscores)</p>
                </div>

                <!-- Label -->
                <div>
                    <label for="label" class="block text-sm font-semibold text-gray-700 mb-2">Display Label *</label>
                    <input type="text" id="label" name="label" value="{{ old('label', $setting->label) }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('label') border-red-500 @enderror"
                           placeholder="e.g., Site Name, Contact Email">
                    @error('label')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Type -->
                <div>
                    <label for="type" class="block text-sm font-semibold text-gray-700 mb-2">Field Type *</label>
                    <select id="type" name="type" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('type') border-red-500 @enderror">
                        <option value="">Select field type</option>
                        <option value="text" {{ old('type', $setting->type) === 'text' ? 'selected' : '' }}>Text Input</option>
                        <option value="textarea" {{ old('type', $setting->type) === 'textarea' ? 'selected' : '' }}>Text Area</option>
                        <option value="number" {{ old('type', $setting->type) === 'number' ? 'selected' : '' }}>Number Input</option>
                        <option value="boolean" {{ old('type', $setting->type) === 'boolean' ? 'selected' : '' }}>Checkbox</option>
                        <option value="image" {{ old('type', $setting->type) === 'image' ? 'selected' : '' }}>Image URL</option>
                    </select>
                    @error('type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Group -->
                <div>
                    <label for="group" class="block text-sm font-semibold text-gray-700 mb-2">Group *</label>
                    <select id="group" name="group" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('group') border-red-500 @enderror">
                        <option value="">Select group</option>
                        <option value="general" {{ old('group', $setting->group) === 'general' ? 'selected' : '' }}>General</option>
                        <option value="email" {{ old('group', $setting->group) === 'email' ? 'selected' : '' }}>Email</option>
                        <option value="payment" {{ old('group', $setting->group) === 'payment' ? 'selected' : '' }}>Payment</option>
                        <option value="social" {{ old('group', $setting->group) === 'social' ? 'selected' : '' }}>Social Media</option>
                        <option value="seo" {{ old('group', $setting->group) === 'seo' ? 'selected' : '' }}>SEO</option>
                        <option value="contact" {{ old('group', $setting->group) === 'contact' ? 'selected' : '' }}>Contact</option>
                        <option value="appearance" {{ old('group', $setting->group) === 'appearance' ? 'selected' : '' }}>Appearance</option>
                    </select>
                    @error('group')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Value -->
                <div>
                    <label for="value" class="block text-sm font-semibold text-gray-700 mb-2">Current Value</label>
                    <textarea id="value" name="value" rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('value') border-red-500 @enderror"
                              placeholder="Enter the value for this setting">{{ old('value', $setting->value) }}</textarea>
                    @error('value')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                    <textarea id="description" name="description" rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror"
                              placeholder="Optional description for this setting">{{ old('description', $setting->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sort Order -->
                <div>
                    <label for="sort_order" class="block text-sm font-semibold text-gray-700 mb-2">Sort Order</label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $setting->sort_order) }}" min="0"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('sort_order') border-red-500 @enderror"
                           placeholder="0">
                    @error('sort_order')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-sm text-gray-500 mt-1">Lower numbers appear first</p>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.settings.index') }}" 
                       class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                        <i class="fas fa-save mr-2"></i>
                        Update Setting
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
