@extends('layouts.admin')

@section('title', 'Edit About Page')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit About Page</h1>
                    <p class="mt-2 text-gray-600">Update about page content</p>
                </div>
                <a href="{{ route('admin.about.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to About Pages
                </a>
            </div>
        </div>

        <!-- Tab Navigation -->
        <div class="bg-white rounded-t-2xl shadow-lg">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs">
                    <button type="button" 
                            onclick="switchTab('basic')"
                            class="tab-button py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200 border-blue-500 text-blue-600"
                            id="tab-basic">
                        <i class="fas fa-info-circle mr-2"></i>
                        Basic Information
                    </button>
                    <button type="button" 
                            onclick="switchTab('content')"
                            class="tab-button py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300"
                            id="tab-content">
                        <i class="fas fa-file-alt mr-2"></i>
                        Content & Media
                    </button>
                    <button type="button" 
                            onclick="switchTab('vision')"
                            class="tab-button py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300"
                            id="tab-vision">
                        <i class="fas fa-eye mr-2"></i>
                        Vision & Mission
                    </button>
                    <button type="button" 
                            onclick="switchTab('features')"
                            class="tab-button py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300"
                            id="tab-features">
                        <i class="fas fa-star mr-2"></i>
                        Features & Statistics
                    </button>
                    <button type="button" 
                            onclick="switchTab('team')"
                            class="tab-button py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300"
                            id="tab-team">
                        <i class="fas fa-users mr-2"></i>
                        Team Members
                    </button>
                    <button type="button" 
                            onclick="switchTab('seo')"
                            class="tab-button py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300"
                            id="tab-seo">
                        <i class="fas fa-search mr-2"></i>
                        SEO & Settings
                    </button>
                </nav>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.about.update', $about) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Tab Content -->
            <!-- Basic Information Tab -->
            <div class="tab-content bg-white rounded-b-2xl shadow-lg p-8" id="content-basic">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Basic Information</h2>
                    <p class="text-gray-600 text-sm mt-1">Enter the basic details for your about page</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Title *</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $about->title) }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror"
                               placeholder="Enter about page title">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Subtitle -->
                    <div>
                        <label for="subtitle" class="block text-sm font-semibold text-gray-700 mb-2">Subtitle</label>
                        <input type="text" id="subtitle" name="subtitle" value="{{ old('subtitle', $about->subtitle) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('subtitle') border-red-500 @enderror"
                               placeholder="Enter subtitle">
                        @error('subtitle')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sort Order -->
                    <div>
                        <label for="sort_order" class="block text-sm font-semibold text-gray-700 mb-2">Sort Order</label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $about->sort_order) }}" min="0"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('sort_order') border-red-500 @enderror"
                               placeholder="0">
                        @error('sort_order')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-sm text-gray-500 mt-1">Lower numbers appear first</p>
                    </div>

                    <!-- Is Active -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                        <div class="flex items-center">
                            <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $about->is_active) ? 'checked' : '' }}
                                   class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="is_active" class="ml-3 text-sm font-medium text-gray-700">Active</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content & Media Tab -->
            <div class="tab-content bg-white rounded-b-2xl shadow-lg p-8 hidden" id="content-content">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Content & Media</h2>
                    <p class="text-gray-600 text-sm mt-1">Add your main content and select images</p>
                </div>

                <div class="space-y-6">
                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">Content *</label>
                        <textarea id="content" name="content" rows="10" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('content') border-red-500 @enderror"
                                  placeholder="Enter about page content">{{ old('content', $about->content) }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Hero Image -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Hero Image</label>
                        
                        <!-- Media Manager Button -->
                        <div class="mb-4">
                            <div id="hero-image-preview" class="mb-4">
                                @if($about->heroMedia)
                                    <img src="{{ $about->heroMedia->url }}" alt="Hero Image" class="h-32 w-32 object-cover rounded-lg">
                                @elseif($about->hero_image)
                                    <img src="{{ asset('storage/' . $about->hero_image) }}" alt="Hero Image" class="h-32 w-32 object-cover rounded-lg">
                                @endif
                            </div>
                            
                            <button type="button" 
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors"
                                    data-media-manager
                                    data-input-id="hero-image-input"
                                    data-preview-id="hero-image-preview"
                                    data-multiple="false"
                                    data-max-selections="1">
                                <i class="fas fa-image mr-2"></i>
                                Select Hero Image
                            </button>
                            
                            <input type="hidden" id="hero-image-input" name="hero_media_id" value="{{ old('hero_media_id', $about->hero_media_id) }}">
                        </div>
                    </div>

                    <!-- Gallery Images -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Gallery Images</label>
                        
                        <div id="gallery-images-input" data-name="gallery_images[]">
                            @if($about->gallery_images)
                                @foreach($about->gallery_images as $imageId)
                                    <input type="hidden" name="gallery_images[]" value="{{ $imageId }}">
                                @endforeach
                            @endif
                        </div>
                        <div id="gallery-images-preview" class="mb-4 grid grid-cols-2 gap-4">
                            @if($about->gallery_images_with_urls)
                                @foreach($about->gallery_images_with_urls as $index => $image)
                                    <div class="relative">
                                        <img src="{{ $image['url'] }}" alt="Gallery Image" class="h-24 w-full object-cover rounded-lg">
                                        <button type="button" onclick="removeGalleryImage(this)" class="absolute top-2 right-2 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-700">
                                            <i class="fas fa-times text-xs"></i>
                                        </button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        
                        <button type="button" 
                                class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors"
                                data-media-manager
                                data-input-id="gallery-images-input"
                                data-preview-id="gallery-images-preview"
                                data-multiple="true"
                                data-max-selections="10">
                            <i class="fas fa-images mr-2"></i>
                            Select Gallery Images
                        </button>
                    </div>
                </div>
            </div>

            <!-- Vision & Mission Tab -->
            <div class="tab-content bg-white rounded-b-2xl shadow-lg p-8 hidden" id="content-vision">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Vision & Mission</h2>
                    <p class="text-gray-600 text-sm mt-1">Define your company's vision, mission, and core values</p>
                </div>

                <div class="space-y-6">
                    <!-- Vision -->
                    <div>
                        <label for="vision" class="block text-sm font-semibold text-gray-700 mb-2">Vision</label>
                        <textarea id="vision" name="vision" rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('vision') border-red-500 @enderror"
                                  placeholder="Enter your company's vision statement">{{ old('vision', $about->vision) }}</textarea>
                        @error('vision')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Mission -->
                    <div>
                        <label for="mission" class="block text-sm font-semibold text-gray-700 mb-2">Mission</label>
                        <textarea id="mission" name="mission" rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('mission') border-red-500 @enderror"
                                  placeholder="Enter your company's mission statement">{{ old('mission', $about->mission) }}</textarea>
                        @error('mission')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Values -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-4">Core Values</label>
                        <div id="values-container" class="space-y-4">
                            @if($about->values && count($about->values) > 0)
                                @foreach($about->values as $index => $value)
                                    <div class="value-item flex space-x-4">
                                        <input type="text" name="values[{{ $index }}][title]" value="{{ $value['title'] ?? '' }}" placeholder="Value Title (e.g., Integrity)" 
                                               class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <input type="text" name="values[{{ $index }}][description]" value="{{ $value['description'] ?? '' }}" placeholder="Value Description" 
                                               class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <button type="button" onclick="removeValue(this)" class="px-3 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                <div class="value-item flex space-x-4">
                                    <input type="text" name="values[0][title]" placeholder="Value Title (e.g., Integrity)" 
                                           class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <input type="text" name="values[0][description]" placeholder="Value Description" 
                                           class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <button type="button" onclick="removeValue(this)" class="px-3 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <button type="button" onclick="addValue()" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            <i class="fas fa-plus mr-2"></i>Add Value
                        </button>
                    </div>
                </div>
            </div>

            <!-- Features & Statistics Tab -->
            <div class="tab-content bg-white rounded-b-2xl shadow-lg p-8 hidden" id="content-features">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Features & Statistics</h2>
                    <p class="text-gray-600 text-sm mt-1">Add features and statistics to showcase your strengths</p>
                </div>

                <div class="space-y-8">
                    <!-- Features -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-4">Features</label>
                        <div id="features-container" class="space-y-4">
                            @if($about->features && count($about->features) > 0)
                                @foreach($about->features as $index => $feature)
                                    <div class="feature-item flex space-x-4">
                                        <input type="text" name="features[{{ $index }}][title]" value="{{ $feature['title'] ?? '' }}" placeholder="Feature Title" 
                                               class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <input type="text" name="features[{{ $index }}][description]" value="{{ $feature['description'] ?? '' }}" placeholder="Feature Description" 
                                               class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <button type="button" onclick="removeFeature(this)" class="px-3 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                <div class="feature-item flex space-x-4">
                                    <input type="text" name="features[0][title]" placeholder="Feature Title" 
                                           class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <input type="text" name="features[0][description]" placeholder="Feature Description" 
                                           class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <button type="button" onclick="removeFeature(this)" class="px-3 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <button type="button" onclick="addFeature()" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            <i class="fas fa-plus mr-2"></i>Add Feature
                        </button>
                    </div>

                    <!-- Statistics -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-4">Statistics</label>
                        <div id="statistics-container" class="space-y-4">
                            @if($about->statistics && count($about->statistics) > 0)
                                @foreach($about->statistics as $index => $statistic)
                                    <div class="statistic-item flex space-x-4">
                                        <input type="text" name="statistics[{{ $index }}][number]" value="{{ $statistic['number'] ?? '' }}" placeholder="Number (e.g., 500+)" 
                                               class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <input type="text" name="statistics[{{ $index }}][label]" value="{{ $statistic['label'] ?? '' }}" placeholder="Label (e.g., Happy Customers)" 
                                               class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <button type="button" onclick="removeStatistic(this)" class="px-3 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                <div class="statistic-item flex space-x-4">
                                    <input type="text" name="statistics[0][number]" placeholder="Number (e.g., 500+)" 
                                           class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <input type="text" name="statistics[0][label]" placeholder="Label (e.g., Happy Customers)" 
                                           class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <button type="button" onclick="removeStatistic(this)" class="px-3 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <button type="button" onclick="addStatistic()" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            <i class="fas fa-plus mr-2"></i>Add Statistic
                        </button>
                    </div>
                </div>
            </div>

            <!-- Team Members Tab -->
            <div class="tab-content bg-white rounded-b-2xl shadow-lg p-8 hidden" id="content-team">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Team Members</h2>
                    <p class="text-gray-600 text-sm mt-1">Add information about your team members</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-4">Team Members</label>
                    <div id="team-container" class="space-y-6">
                        @if($about->team_members && count($about->team_members) > 0)
                            @foreach($about->team_members as $index => $member)
                                <div class="team-item bg-gray-50 p-4 rounded-xl">
                                    <div class="flex items-start space-x-4 mb-4">
                                        <!-- Team Member Image -->
                                        <div class="flex-shrink-0">
                                            <div id="team-image-preview-{{ $index }}" class="mb-2">
                                                @if(isset($about->team_member_images[$index]['image_id']))
                                                    @php
                                                        $media = \App\Models\Media::find($about->team_member_images[$index]['image_id']);
                                                    @endphp
                                                    @if($media)
                                                        <img src="{{ $media->url }}" alt="Team Member" class="h-20 w-20 object-cover rounded-lg">
                                                    @endif
                                                @endif
                                            </div>
                                            <button type="button" 
                                                    class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors"
                                                    data-media-manager
                                                    data-input-id="team-image-input-{{ $index }}"
                                                    data-preview-id="team-image-preview-{{ $index }}"
                                                    data-multiple="false"
                                                    data-max-selections="1">
                                                <i class="fas fa-image mr-2"></i>
                                                Select Image
                                            </button>
                                            <input type="hidden" id="team-image-input-{{ $index }}" name="team_member_images[{{ $index }}]" value="{{ $about->team_member_images[$index]['image_id'] ?? '' }}">
                                        </div>
                                        
                                        <!-- Team Member Details -->
                                        <div class="flex-1 space-y-3">
                                            <input type="text" name="team_members[{{ $index }}][name]" value="{{ $member['name'] ?? '' }}" placeholder="Name" 
                                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <input type="text" name="team_members[{{ $index }}][position]" value="{{ $member['position'] ?? '' }}" placeholder="Position" 
                                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <textarea name="team_members[{{ $index }}][description]" rows="2" placeholder="Description" 
                                                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ $member['description'] ?? '' }}</textarea>
                                        </div>
                                        
                                        <!-- Remove Button -->
                                        <div class="flex-shrink-0">
                                            <button type="button" onclick="removeTeamMember(this)" class="px-3 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="team-item bg-gray-50 p-4 rounded-xl">
                                <div class="flex items-start space-x-4 mb-4">
                                    <!-- Team Member Image -->
                                    <div class="flex-shrink-0">
                                        <div id="team-image-preview-0" class="mb-2"></div>
                                        <button type="button" 
                                                class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors"
                                                data-media-manager
                                                data-input-id="team-image-input-0"
                                                data-preview-id="team-image-preview-0"
                                                data-multiple="false"
                                                data-max-selections="1">
                                            <i class="fas fa-image mr-2"></i>
                                            Select Image
                                        </button>
                                        <input type="hidden" id="team-image-input-0" name="team_member_images[0]" value="">
                                    </div>
                                    
                                    <!-- Team Member Details -->
                                    <div class="flex-1 space-y-3">
                                        <input type="text" name="team_members[0][name]" placeholder="Name" 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <input type="text" name="team_members[0][position]" placeholder="Position" 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <textarea name="team_members[0][description]" rows="2" placeholder="Description" 
                                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                                    </div>
                                    
                                    <!-- Remove Button -->
                                    <div class="flex-shrink-0">
                                        <button type="button" onclick="removeTeamMember(this)" class="px-3 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <button type="button" onclick="addTeamMember()" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        <i class="fas fa-plus mr-2"></i>Add Team Member
                    </button>
                </div>
            </div>

            <!-- SEO & Settings Tab -->
            <div class="tab-content bg-white rounded-b-2xl shadow-lg p-8 hidden" id="content-seo">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-900">SEO & Settings</h2>
                    <p class="text-gray-600 text-sm mt-1">Configure SEO settings and page options</p>
                </div>

                <div class="space-y-6">
                    <!-- Meta Title -->
                    <div>
                        <label for="meta_title" class="block text-sm font-semibold text-gray-700 mb-2">Meta Title</label>
                        <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $about->meta_title) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('meta_title') border-red-500 @enderror"
                               placeholder="Enter meta title for SEO">
                        @error('meta_title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Meta Description -->
                    <div>
                        <label for="meta_description" class="block text-sm font-semibold text-gray-700 mb-2">Meta Description</label>
                        <textarea id="meta_description" name="meta_description" rows="3"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('meta_description') border-red-500 @enderror"
                                  placeholder="Enter meta description for SEO">{{ old('meta_description', $about->meta_description) }}</textarea>
                        @error('meta_description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end mt-6">
                <div class="flex space-x-4">
                    <a href="{{ route('admin.about.index') }}" 
                       class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                        <i class="fas fa-save mr-2"></i>
                        Update About Page
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Tab switching functionality
function switchTab(tabName) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Remove active state from all tab buttons
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('border-blue-500', 'text-blue-600');
        button.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Show selected tab content
    document.getElementById('content-' + tabName).classList.remove('hidden');
    
    // Add active state to selected tab button
    const activeButton = document.getElementById('tab-' + tabName);
    activeButton.classList.remove('border-transparent', 'text-gray-500');
    activeButton.classList.add('border-blue-500', 'text-blue-600');
}

// Dynamic form functionality
let featureIndex = {{ $about->features ? count($about->features) : 1 }};
let statisticIndex = {{ $about->statistics ? count($about->statistics) : 1 }};
let teamIndex = {{ $about->team_members ? count($about->team_members) : 1 }};
let valueIndex = {{ $about->values ? count($about->values) : 1 }};

function addFeature() {
    const container = document.getElementById('features-container');
    const div = document.createElement('div');
    div.className = 'feature-item flex space-x-4';
    div.innerHTML = `
        <input type="text" name="features[${featureIndex}][title]" placeholder="Feature Title" 
               class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        <input type="text" name="features[${featureIndex}][description]" placeholder="Feature Description" 
               class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        <button type="button" onclick="removeFeature(this)" class="px-3 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700">
            <i class="fas fa-trash"></i>
        </button>
    `;
    container.appendChild(div);
    featureIndex++;
}

function removeFeature(button) {
    button.parentElement.remove();
}

function addStatistic() {
    const container = document.getElementById('statistics-container');
    const div = document.createElement('div');
    div.className = 'statistic-item flex space-x-4';
    div.innerHTML = `
        <input type="text" name="statistics[${statisticIndex}][number]" placeholder="Number (e.g., 500+)" 
               class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        <input type="text" name="statistics[${statisticIndex}][label]" placeholder="Label (e.g., Happy Customers)" 
               class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        <button type="button" onclick="removeStatistic(this)" class="px-3 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700">
            <i class="fas fa-trash"></i>
        </button>
    `;
    container.appendChild(div);
    statisticIndex++;
}

function removeStatistic(button) {
    button.parentElement.remove();
}

function addTeamMember() {
    const container = document.getElementById('team-container');
    const div = document.createElement('div');
    div.className = 'team-item bg-gray-50 p-4 rounded-xl';
    div.innerHTML = `
        <div class="flex items-start space-x-4 mb-4">
            <!-- Team Member Image -->
            <div class="flex-shrink-0">
                <div id="team-image-preview-${teamIndex}" class="mb-2"></div>
                <button type="button" 
                        class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors"
                        data-media-manager
                        data-input-id="team-image-input-${teamIndex}"
                        data-preview-id="team-image-preview-${teamIndex}"
                        data-multiple="false"
                        data-max-selections="1">
                    <i class="fas fa-image mr-2"></i>
                    Select Image
                </button>
                <input type="hidden" id="team-image-input-${teamIndex}" name="team_member_images[${teamIndex}]" value="">
            </div>
            
            <!-- Team Member Details -->
            <div class="flex-1 space-y-3">
                <input type="text" name="team_members[${teamIndex}][name]" placeholder="Name" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <input type="text" name="team_members[${teamIndex}][position]" placeholder="Position" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <textarea name="team_members[${teamIndex}][description]" rows="2" placeholder="Description" 
                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
            </div>
            
            <!-- Remove Button -->
            <div class="flex-shrink-0">
                <button type="button" onclick="removeTeamMember(this)" class="px-3 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    `;
    container.appendChild(div);
    
    // Re-initialize media manager for the new element
    setTimeout(() => {
        const newButton = div.querySelector('[data-media-manager]');
        if (newButton) {
            newButton.addEventListener('click', function() {
                const inputId = this.getAttribute('data-input-id');
                const previewId = this.getAttribute('data-preview-id');
                const multiple = this.getAttribute('data-multiple') === 'true';
                const maxSelections = parseInt(this.getAttribute('data-max-selections')) || 1;
                
                openMediaManager({
                    multiple: multiple,
                    maxSelections: maxSelections,
                    callback: function(selectedImages) {
                        const input = document.getElementById(inputId);
                        const preview = document.getElementById(previewId);
                        
                        if (input && preview) {
                            if (multiple) {
                                input.value = selectedImages.map(img => img.id).join(',');
                                preview.innerHTML = selectedImages.map(img => 
                                    `<img src="${img.url}" alt="${img.alt}" class="h-20 w-20 object-cover rounded-lg">`
                                ).join('');
                            } else {
                                const img = selectedImages[0];
                                input.value = img.id;
                                preview.innerHTML = `<img src="${img.url}" alt="${img.alt}" class="h-20 w-20 object-cover rounded-lg">`;
                            }
                        }
                    }
                });
            });
        }
    }, 100);
    
    teamIndex++;
}

function removeTeamMember(button) {
    button.parentElement.remove();
}

function removeGalleryImage(button) {
    button.parentElement.remove();
}

function addValue() {
    const container = document.getElementById('values-container');
    const div = document.createElement('div');
    div.className = 'value-item flex space-x-4';
    div.innerHTML = `
        <input type="text" name="values[${valueIndex}][title]" placeholder="Value Title (e.g., Integrity)" 
               class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        <input type="text" name="values[${valueIndex}][description]" placeholder="Value Description" 
               class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        <button type="button" onclick="removeValue(this)" class="px-3 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700">
            <i class="fas fa-trash"></i>
        </button>
    `;
    container.appendChild(div);
    valueIndex++;
}

function removeValue(button) {
    button.parentElement.remove();
}
</script>
@endsection
