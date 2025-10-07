@extends('layouts.admin')

@section('title', 'View Review - Admin Panel')
@section('page-title', 'Review Details')
@section('page-description', 'Customer review by ' . $review->customer_name)

@section('header-actions')
<div class="flex space-x-2">
    <a href="{{ route('admin.reviews.edit', $review) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition-all duration-300 text-sm">
        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
        </svg>
        Edit Review
    </a>
    <a href="{{ route('admin.reviews.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-semibold transition-all duration-300 text-sm">
        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Back to Reviews
    </a>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Review Details -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Review Card -->
        <div class="bg-white rounded-lg shadow-md p-8">
            <!-- Review Header -->
            <div class="flex items-center mb-6">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-green-500 rounded-full flex items-center justify-center mr-4">
                    <span class="text-white font-bold text-xl">{{ substr($review->customer_name, 0, 1) }}</span>
                </div>
                <div class="flex-1">
                    <h3 class="text-xl font-bold text-gray-900">{{ $review->customer_name }}</h3>
                    <p class="text-gray-600">{{ $review->customer_location }}</p>
                    @if($review->customer_email)
                    <p class="text-sm text-gray-500">{{ $review->customer_email }}</p>
                    @endif
                </div>
                <div class="flex items-center space-x-2">
                    @if($review->is_verified)
                    <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-medium">
                        <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Verified
                    </span>
                    @endif
                </div>
            </div>
            
            <!-- Star Rating -->
            <div class="flex items-center mb-6">
                <div class="flex text-yellow-400 text-2xl mr-4">
                    {!! $review->star_rating !!}
                </div>
                <span class="text-2xl font-bold text-gray-900">{{ $review->rating }}/5</span>
                <span class="ml-4 text-sm text-gray-600">{{ $review->formatted_review_date }}</span>
            </div>
            
            <!-- Review Text -->
            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                <p class="text-gray-700 leading-relaxed text-lg">"{{ $review->review_text }}"</p>
            </div>
            
            <!-- Package Info -->
            <div class="border-t border-gray-200 pt-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-2">Reviewed Package</h4>
                <div class="flex items-center">
                    <img src="{{ $review->package->image_url }}" alt="{{ $review->package->title }}" class="w-16 h-16 object-cover rounded-lg mr-4">
                    <div>
                        <p class="font-semibold text-gray-900">{{ $review->package->title }}</p>
                        <p class="text-sm text-gray-600">{{ $review->package->duration }}</p>
                        <p class="text-sm text-gray-500">{{ $review->package->category->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Review Status & Actions -->
    <div class="space-y-6">
        <!-- Status Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Review Status</h3>
            
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-700">Approved</span>
                    @if($review->is_approved)
                    <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-medium">
                        <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Yes
                    </span>
                    @else
                    <span class="inline-block bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full font-medium">
                        <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        No
                    </span>
                    @endif
                </div>
                
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-700">Featured</span>
                    @if($review->is_featured)
                    <span class="inline-block bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full font-medium">
                        <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        Yes
                    </span>
                    @else
                    <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full font-medium">
                        No
                    </span>
                    @endif
                </div>
                
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-700">Verified</span>
                    @if($review->is_verified)
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full font-medium">
                        <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Yes
                    </span>
                    @else
                    <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full font-medium">
                        No
                    </span>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
            
            <div class="space-y-3">
                <!-- Toggle Approval -->
                <form action="{{ route('admin.reviews.toggle-approval', $review) }}" method="POST" class="w-full">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white {{ $review->is_approved ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} transition-colors duration-200">
                        @if($review->is_approved)
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>
                        </svg>
                        Unapprove Review
                        @else
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Approve Review
                        @endif
                    </button>
                </form>
                
                <!-- Toggle Featured -->
                <form action="{{ route('admin.reviews.toggle-featured', $review) }}" method="POST" class="w-full">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white {{ $review->is_featured ? 'bg-gray-600 hover:bg-gray-700' : 'bg-purple-600 hover:bg-purple-700' }} transition-colors duration-200">
                        @if($review->is_featured)
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8l4 4-4 4"></path>
                        </svg>
                        Remove from Featured
                        @else
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        Mark as Featured
                        @endif
                    </button>
                </form>
                
                <!-- Delete Review -->
                <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" class="w-full" onsubmit="return confirm('Are you sure you want to delete this review? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 border border-red-300 text-sm font-medium rounded-md text-red-700 bg-red-50 hover:bg-red-100 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete Review
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Review Metadata -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Review Details</h3>
            
            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">Review ID:</span>
                    <span class="font-medium text-gray-900">#{{ $review->id }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Created:</span>
                    <span class="font-medium text-gray-900">{{ $review->created_at->format('M d, Y H:i') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Last Updated:</span>
                    <span class="font-medium text-gray-900">{{ $review->updated_at->format('M d, Y H:i') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Review Date:</span>
                    <span class="font-medium text-gray-900">{{ $review->formatted_review_date }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
