@extends('layouts.admin')

@section('title', 'Create Review - Admin Panel')
@section('page-title', 'Create New Review')
@section('page-description', 'Add a new customer review')

@section('content')
<!-- Create Review Form -->
<form action="{{ route('admin.reviews.store') }}" method="POST" class="space-y-8">
    @csrf
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Review Information</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Package Selection -->
            <div>
                <label for="package_id" class="block text-sm font-medium text-gray-700 mb-2">Package *</label>
                <select name="package_id" id="package_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" required>
                    <option value="">Select a package</option>
                    @foreach($packages as $package)
                    <option value="{{ $package->id }}" {{ old('package_id') == $package->id ? 'selected' : '' }}>
                        {{ $package->title }}
                    </option>
                    @endforeach
                </select>
                @error('package_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Rating -->
            <div>
                <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">Rating *</label>
                <select name="rating" id="rating" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" required>
                    <option value="">Select rating</option>
                    <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>1 Star - Poor</option>
                    <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>2 Stars - Fair</option>
                    <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>3 Stars - Good</option>
                    <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>4 Stars - Very Good</option>
                    <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>5 Stars - Excellent</option>
                </select>
                @error('rating')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Customer Information</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Customer Name -->
            <div>
                <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-2">Customer Name *</label>
                <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                       placeholder="Enter customer name" required>
                @error('customer_name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Customer Email -->
            <div>
                <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-2">Customer Email</label>
                <input type="email" name="customer_email" id="customer_email" value="{{ old('customer_email') }}" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                       placeholder="customer@example.com">
                @error('customer_email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Customer Location -->
            <div>
                <label for="customer_location" class="block text-sm font-medium text-gray-700 mb-2">Customer Location</label>
                <input type="text" name="customer_location" id="customer_location" value="{{ old('customer_location') }}" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                       placeholder="City, Country">
                @error('customer_location')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Review Content</h3>
        
        <!-- Review Text -->
        <div class="mb-6">
            <label for="review_text" class="block text-sm font-medium text-gray-700 mb-2">Review Text *</label>
            <textarea name="review_text" id="review_text" rows="6" 
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                      placeholder="Write the customer's review here..." required>{{ old('review_text') }}</textarea>
            @error('review_text')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Review Date -->
        <div>
            <label for="review_date" class="block text-sm font-medium text-gray-700 mb-2">Review Date</label>
            <input type="date" name="review_date" id="review_date" value="{{ old('review_date', date('Y-m-d')) }}" 
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
            @error('review_date')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Review Settings</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Verified Status -->
            <div class="flex items-center">
                <input type="checkbox" name="is_verified" id="is_verified" value="1" {{ old('is_verified') ? 'checked' : '' }}
                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="is_verified" class="ml-2 text-sm font-medium text-gray-700">Verified Review</label>
            </div>

            <!-- Featured Status -->
            <div class="flex items-center">
                <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="is_featured" class="ml-2 text-sm font-medium text-gray-700">Featured Review</label>
            </div>

            <!-- Approved Status -->
            <div class="flex items-center">
                <input type="checkbox" name="is_approved" id="is_approved" value="1" {{ old('is_approved', true) ? 'checked' : '' }}
                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="is_approved" class="ml-2 text-sm font-medium text-gray-700">Approved Review</label>
            </div>
        </div>
    </div>

    <!-- Form Actions -->
    <div class="flex items-center justify-end space-x-4">
        <a href="{{ route('admin.reviews.index') }}" 
           class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200 font-medium">
            Cancel
        </a>
        <button type="submit" 
                class="px-6 py-3 bg-gradient-to-r from-blue-600 to-green-600 hover:from-blue-700 hover:to-green-700 text-white rounded-lg font-medium transition-all duration-300 transform hover:scale-105 shadow-lg">
            Create Review
        </button>
    </div>
</form>
@endsection
