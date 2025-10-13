@extends('layouts.admin')

@section('title', 'About Page')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">About Page</h1>
                    <p class="mt-2 text-gray-600">Manage your about page content</p>
                </div>
                <div class="flex space-x-3">
                    @if($about)
                        <a href="{{ route('admin.about.edit') }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                            <i class="fas fa-edit mr-2"></i>
                            Edit About Page
                        </a>
                    @else
                        <a href="{{ route('admin.about.create') }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                            <i class="fas fa-plus mr-2"></i>
                            Create About Page
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ session('error') }}
            </div>
        @endif

        @if(session('info'))
            <div class="mb-6 bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg">
                <i class="fas fa-info-circle mr-2"></i>
                {{ session('info') }}
            </div>
        @endif

        <!-- About Page Content -->
        @if($about)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-8">
                    <div class="flex items-start space-x-6">
                        <!-- Hero Image -->
                        <div class="flex-shrink-0">
                            @if($about->heroMedia)
                                <img class="h-32 w-32 rounded-lg object-cover" src="{{ $about->heroMedia->url }}" alt="{{ $about->title }}">
                            @elseif($about->hero_image)
                                <img class="h-32 w-32 rounded-lg object-cover" src="{{ asset('storage/' . $about->hero_image) }}" alt="{{ $about->title }}">
                            @else
                                <div class="h-32 w-32 rounded-lg bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400 text-2xl"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-2xl font-bold text-gray-900">{{ $about->title }}</h2>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $about->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $about->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            
                            @if($about->subtitle)
                                <p class="text-lg text-gray-600 mb-4">{{ $about->subtitle }}</p>
                            @endif
                            
                            <div class="text-gray-700 mb-6">
                                {!! Str::limit(strip_tags($about->content), 300) !!}
                                @if(strlen(strip_tags($about->content)) > 300)
                                    <span class="text-blue-600">...</span>
                                @endif
                            </div>

                            <!-- Meta Information -->
                            <div class="grid grid-cols-2 gap-4 text-sm text-gray-500 mb-6">
                                <div>
                                    <span class="font-medium">Sort Order:</span> {{ $about->sort_order }}
                                </div>
                                <div>
                                    <span class="font-medium">Created:</span> {{ $about->created_at->format('M d, Y') }}
                                </div>
                                @if($about->meta_title)
                                    <div>
                                        <span class="font-medium">Meta Title:</span> {{ Str::limit($about->meta_title, 30) }}
                                    </div>
                                @endif
                                @if($about->features && count($about->features) > 0)
                                    <div>
                                        <span class="font-medium">Features:</span> {{ count($about->features) }}
                                    </div>
                                @endif
                                @if($about->vision)
                                    <div>
                                        <span class="font-medium">Vision:</span> {{ Str::limit($about->vision, 40) }}
                                    </div>
                                @endif
                                @if($about->mission)
                                    <div>
                                        <span class="font-medium">Mission:</span> {{ Str::limit($about->mission, 40) }}
                                    </div>
                                @endif
                                @if($about->values && count($about->values) > 0)
                                    <div>
                                        <span class="font-medium">Values:</span> {{ count($about->values) }}
                                    </div>
                                @endif
                            </div>

                            <!-- Vision, Mission & Values Preview -->
                            @if($about->vision || $about->mission || ($about->values && count($about->values) > 0))
                            <div class="bg-gray-50 rounded-xl p-6 mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    <i class="fas fa-eye mr-2 text-blue-600"></i>
                                    Vision, Mission & Values
                                </h3>
                                
                                <div class="space-y-4">
                                    @if($about->vision)
                                    <div>
                                        <h4 class="font-medium text-gray-700 mb-2 flex items-center">
                                            <i class="fas fa-eye mr-2 text-blue-500"></i>
                                            Vision
                                        </h4>
                                        <p class="text-gray-600 text-sm bg-white p-3 rounded-lg border-l-4 border-blue-500">
                                            {{ $about->vision }}
                                        </p>
                                    </div>
                                    @endif
                                    
                                    @if($about->mission)
                                    <div>
                                        <h4 class="font-medium text-gray-700 mb-2 flex items-center">
                                            <i class="fas fa-bullseye mr-2 text-green-500"></i>
                                            Mission
                                        </h4>
                                        <p class="text-gray-600 text-sm bg-white p-3 rounded-lg border-l-4 border-green-500">
                                            {{ $about->mission }}
                                        </p>
                                    </div>
                                    @endif
                                    
                                    @if($about->values && count($about->values) > 0)
                                    <div>
                                        <h4 class="font-medium text-gray-700 mb-2 flex items-center">
                                            <i class="fas fa-heart mr-2 text-purple-500"></i>
                                            Core Values ({{ count($about->values) }})
                                        </h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                            @foreach($about->values as $value)
                                            <div class="bg-white p-3 rounded-lg border-l-4 border-purple-500">
                                                <div class="font-medium text-gray-800 text-sm">{{ $value['title'] ?? 'Value' }}</div>
                                                <div class="text-gray-600 text-xs mt-1">{{ Str::limit($value['description'] ?? '', 60) }}</div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            <!-- Actions -->
                            <div class="flex space-x-3">
                                <a href="{{ route('admin.about.edit') }}" 
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                                    <i class="fas fa-edit mr-2"></i>
                                    Edit
                                </a>
                                <a href="{{ route('about') }}" target="_blank"
                                   class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors">
                                    <i class="fas fa-external-link-alt mr-2"></i>
                                    View Live
                                </a>
                                <form action="{{ route('admin.about.destroy') }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors"
                                            onclick="return confirm('Are you sure you want to delete the about page?')">
                                        <i class="fas fa-trash mr-2"></i>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
                <i class="fas fa-file-alt text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No About Page Found</h3>
                <p class="text-gray-500 mb-6">Get started by creating your about page.</p>
                <a href="{{ route('admin.about.create') }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                    <i class="fas fa-plus mr-2"></i>
                    Create About Page
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
