@extends('layouts.admin')

@section('title', 'Edit Blog Post - Admin Panel')
@section('page-title', 'Edit Blog Post')
@section('page-description', 'Update your blog post content - ' . $blog->title)

@section('header-actions')
<a href="{{ route('blog.show', $blog->slug) }}" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition-all duration-300 text-sm">
    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
    </svg>
    View Post
</a>
@endsection

@section('content')
<!-- Edit Form -->
<form action="{{ route('admin.blog.update', $blog) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf
    @method('PUT')
                
                <!-- Basic Information -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Basic Information</h2>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="lg:col-span-2">
                            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Title *</label>
                            <input type="text" id="title" name="title" value="{{ old('title', $blog->title) }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror"
                                placeholder="Enter blog post title">
                            @error('title')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="blog_category_id" class="block text-sm font-semibold text-gray-700 mb-2">Category *</label>
                            <select id="blog_category_id" name="blog_category_id" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('blog_category_id') border-red-500 @enderror">
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('blog_category_id', $blog->blog_category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('blog_category_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="published_at" class="block text-sm font-semibold text-gray-700 mb-2">Publish Date</label>
                            <input type="datetime-local" id="published_at" name="published_at" value="{{ old('published_at', $blog->published_at ? $blog->published_at->format('Y-m-d\TH:i') : '') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <label for="excerpt" class="block text-sm font-semibold text-gray-700 mb-2">Excerpt</label>
                        <textarea id="excerpt" name="excerpt" rows="3"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('excerpt') border-red-500 @enderror"
                            placeholder="Brief description of the blog post">{{ old('excerpt', $blog->excerpt) }}</textarea>
                        @error('excerpt')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Content -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Content</h2>
                    
                    <div>
                        <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">Content *</label>
                        <textarea id="content" name="content" rows="15" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('content') border-red-500 @enderror"
                            placeholder="Write your blog post content here...">{{ old('content', $blog->content) }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Images -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Images</h2>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Featured Image -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Featured Image</label>
                            
                            <div id="featured-image-preview" class="mb-4">
                                @if($blog->media)
                                    <div class="relative w-full h-48">
                                        <img src="{{ $blog->media->url }}" alt="{{ $blog->media->name }}" class="w-full h-full object-cover rounded-xl">
                                        <button type="button" onclick="removeSingleImage()" 
                                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600">
                                            <i class="fas fa-times text-xs"></i>
                                        </button>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-2">{{ $blog->media->name }}</p>
                                @elseif($blog->featured_image)
                                    <div class="relative w-full h-48">
                                        <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="Current featured image" class="w-full h-full object-cover rounded-xl">
                                        <button type="button" onclick="removeSingleImage()" 
                                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600">
                                            <i class="fas fa-times text-xs"></i>
                                        </button>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-2">Current featured image</p>
                                @else
                                    <div class="w-full h-48 border-2 border-dashed border-gray-300 rounded-xl flex items-center justify-center">
                                        <span class="text-gray-500">No image selected</span>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="text-center">
                                <button type="button" 
                                        data-media-manager="true"
                                        data-input-id="featured-image-input"
                                        data-preview-id="featured-image-preview"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                                    <i class="fas fa-image mr-2"></i>{{ $blog->media || $blog->featured_image ? 'Change Featured Image' : 'Choose Featured Image' }}
                                </button>
                            </div>
                            
                            <input type="hidden" id="featured-image-input" name="media_id" value="{{ old('media_id', $blog->media_id) }}">
                        </div>
                        
                        <!-- Gallery Images -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Gallery Images (Optional)</label>
                            
                            <div id="gallery-images-input" data-name="gallery_images[]">
                                @if($blog->gallery_images && count($blog->gallery_images) > 0)
                                    @foreach($blog->gallery_images as $imageId)
                                        <input type="hidden" name="gallery_images[]" value="{{ $imageId }}">
                                    @endforeach
                                @endif
                            </div>
                            
                            <div id="gallery-images-preview" class="mb-4 grid grid-cols-2 gap-4">
                                @if($blog->gallery_images && count($blog->gallery_images) > 0)
                                    @foreach($blog->gallery_images as $imageId)
                                        @php
                                            $image = \App\Models\Media::find($imageId);
                                        @endphp
                                        @if($image)
                                            <div class="relative">
                                                <img src="{{ $image->url }}" alt="{{ $image->original_name }}" class="w-full h-24 object-cover rounded-lg" data-id="{{ $image->id }}">
                                                <button type="button" onclick="removeGalleryImage(this)" 
                                                        class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600">
                                                    <i class="fas fa-times text-xs"></i>
                                                </button>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            
                            <div class="text-center">
                                <button type="button" 
                                        data-media-manager="true"
                                        data-input-id="gallery-images-input"
                                        data-preview-id="gallery-images-preview"
                                        data-multiple="true"
                                        data-max-selections="10"
                                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                                    <i class="fas fa-images mr-2"></i>Add Gallery Images
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    @error('media_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    @error('gallery_images')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- SEO & Settings -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">SEO & Settings</h2>
                    
                    <div class="space-y-6">
                        <div>
                            <label for="meta_title" class="block text-sm font-semibold text-gray-700 mb-2">Meta Title</label>
                            <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $blog->meta_title) }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="SEO title for search engines">
                        </div>
                        
                        <div>
                            <label for="meta_description" class="block text-sm font-semibold text-gray-700 mb-2">Meta Description</label>
                            <textarea id="meta_description" name="meta_description" rows="3"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="SEO description for search engines">{{ old('meta_description', $blog->meta_description) }}</textarea>
                        </div>
                        
                        <div>
                            <label for="tags" class="block text-sm font-semibold text-gray-700 mb-2">Tags</label>
                            <input type="text" id="tags" name="tags" value="{{ old('tags', $blog->tags ? implode(', ', $blog->tags) : '') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Enter tags separated by commas">
                            <p class="text-sm text-gray-500 mt-1">Separate tags with commas (e.g., travel, sri lanka, adventure)</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex items-center">
                                <input type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published', $blog->is_published) ? 'checked' : '' }}
                                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="is_published" class="ml-3 text-sm font-medium text-gray-700">Published</label>
                            </div>
                            
                            <div class="flex items-center">
                                <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $blog->is_featured) ? 'checked' : '' }}
                                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="is_featured" class="ml-3 text-sm font-medium text-gray-700">Featured post</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.blog.index') }}" class="px-8 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-colors duration-300">
                        Cancel
                    </a>
                    <button type="submit" class="bg-gradient-to-r from-blue-600 to-green-600 hover:from-blue-700 hover:to-green-700 text-white px-8 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Update Blog Post
                    </button>
                </div>
            </form>

@endsection

