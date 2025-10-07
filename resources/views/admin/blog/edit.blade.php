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
                            
                            @if($blog->featured_image)
                            <div class="mb-4">
                                <img src="{{ $blog->featured_image_url }}" alt="Current featured image" class="w-full h-48 object-cover rounded-xl mb-2">
                                <p class="text-sm text-gray-600">Current featured image</p>
                            </div>
                            @endif
                            
                            <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-blue-400 transition-colors duration-200">
                                <input type="file" id="featured_image" name="featured_image" accept="image/*" class="hidden" onchange="previewFeaturedImage(this)">
                                <label for="featured_image" class="cursor-pointer">
                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="text-gray-600 mb-2">{{ $blog->featured_image ? 'Replace featured image' : 'Upload featured image' }}</p>
                                    <p class="text-sm text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                </label>
                            </div>
                            <div id="featured-preview" class="mt-4 hidden">
                                <img id="featured-preview-img" src="" alt="Featured image preview" class="w-full h-48 object-cover rounded-xl">
                            </div>
                        </div>
                        
                        <!-- Gallery Images -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Gallery Images</label>
                            
                            @if($blog->gallery_images_url && count($blog->gallery_images_url) > 0)
                            <div class="mb-4">
                                <div class="grid grid-cols-2 gap-2 mb-2">
                                    @foreach($blog->gallery_images_url as $image)
                                    <img src="{{ $image }}" alt="Gallery image" class="w-full h-24 object-cover rounded-lg">
                                    @endforeach
                                </div>
                                <p class="text-sm text-gray-600">Current gallery images</p>
                            </div>
                            @endif
                            
                            <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-blue-400 transition-colors duration-200">
                                <input type="file" id="images" name="images[]" accept="image/*" multiple class="hidden" onchange="previewGalleryImages(this)">
                                <label for="images" class="cursor-pointer">
                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="text-gray-600 mb-2">{{ ($blog->gallery_images_url && count($blog->gallery_images_url) > 0) ? 'Add more gallery images' : 'Upload gallery images' }}</p>
                                    <p class="text-sm text-gray-500">Multiple images allowed</p>
                                </label>
                            </div>
                            <div id="gallery-preview" class="mt-4 grid grid-cols-2 gap-2 hidden">
                                <!-- Gallery preview images will be inserted here -->
                            </div>
                        </div>
                    </div>
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

<script>
function previewFeaturedImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('featured-preview-img').src = e.target.result;
            document.getElementById('featured-preview').classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function previewGalleryImages(input) {
    const preview = document.getElementById('gallery-preview');
    preview.innerHTML = '';
    
    if (input.files) {
        Array.from(input.files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-full h-24 object-cover rounded-lg';
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
        preview.classList.remove('hidden');
    }
}
</script>
@endsection

