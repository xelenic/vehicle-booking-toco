@extends('layouts.app')

@section('title', $blog->meta_title ?: $blog->title . ' - Ceylon Mirissa')
@section('description', $blog->meta_description ?: Str::limit($blog->excerpt, 160))

@section('content')
<!-- Hero Section with Featured Image -->
<section class="relative h-screen overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ $blog->featured_image_url }}')"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/40"></div>
    
    <!-- Blog Info Overlay -->
    <div class="absolute bottom-0 left-0 right-0 z-10 p-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-8 shadow-2xl">
                <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                    <div class="flex-1">
                        <div class="flex items-center gap-4 mb-4">
                            <span class="text-white px-4 py-2 rounded-full text-sm font-semibold" style="background-color: {{ $blog->category->color }}">
                                {{ $blog->category->name }}
                            </span>
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 text-blue-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <span class="font-semibold">{{ $blog->views_count }} views</span>
                            </div>
                        </div>
                        <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 playfair mb-4">
                            {{ $blog->title }}
                        </h1>
                        <p class="text-lg text-gray-600 mb-4">
                            {{ $blog->excerpt }}
                        </p>
                        <div class="flex items-center gap-6 text-gray-600">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $blog->formatted_published_date }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $blog->reading_time }} min read
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Blog Content Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
                <!-- Main Content -->
                <div class="lg:col-span-3">
                    <!-- Blog Content -->
                    <article class="prose prose-lg max-w-none mb-12">
                        {!! $blog->content !!}
                    </article>

                    <!-- Tags -->
                    @if($blog->tags && count($blog->tags) > 0)
                    <div class="mb-12">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Tags</h3>
                        <div class="flex flex-wrap gap-3">
                            @foreach($blog->tags as $tag)
                            <span class="bg-blue-50 text-blue-600 px-4 py-2 rounded-full text-sm font-medium hover:bg-blue-100 transition-colors duration-300 cursor-pointer">
                                {{ $tag }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Share Buttons -->
                    <div class="mb-12">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Share This Story</h3>
                        <div class="flex gap-4">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors duration-300">
                                <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                                Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}" target="_blank" class="bg-blue-400 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-500 transition-colors duration-300">
                                <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                                Twitter
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" class="bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800 transition-colors duration-300">
                                <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                                LinkedIn
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Author Info -->
                    <div class="bg-gray-50 rounded-2xl p-6 mb-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">About Ceylon Mirissa</h3>
                        <p class="text-gray-600 mb-4">We're passionate about showcasing the beauty and culture of Sri Lanka through authentic travel experiences and stories.</p>
                        <a href="{{ route('about') }}" class="text-blue-600 hover:text-blue-700 font-semibold transition-colors duration-300">
                            Learn More About Us →
                        </a>
                    </div>

                    <!-- Recent Posts -->
                    @if($recentBlogs->count() > 0)
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 mb-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Recent Stories</h3>
                        <div class="space-y-4">
                            @foreach($recentBlogs as $recentBlog)
                            <div class="flex gap-3">
                                <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0">
                                    <img src="{{ $recentBlog->featured_image_url }}" alt="{{ $recentBlog->title }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-semibold text-gray-900 mb-1 line-clamp-2">
                                        <a href="{{ route('blog.show', $recentBlog->slug) }}" class="hover:text-blue-600 transition-colors duration-300">
                                            {{ $recentBlog->title }}
                                        </a>
                                    </h4>
                                    <p class="text-xs text-gray-500">{{ $recentBlog->formatted_published_date }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Related Posts -->
                    @if($relatedBlogs->count() > 0)
                    <div class="bg-white border border-gray-200 rounded-2xl p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Related Stories</h3>
                        <div class="space-y-4">
                            @foreach($relatedBlogs as $relatedBlog)
                            <div class="flex gap-3">
                                <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0">
                                    <img src="{{ $relatedBlog->featured_image_url }}" alt="{{ $relatedBlog->title }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-semibold text-gray-900 mb-1 line-clamp-2">
                                        <a href="{{ route('blog.show', $relatedBlog->slug) }}" class="hover:text-blue-600 transition-colors duration-300">
                                            {{ $relatedBlog->title }}
                                        </a>
                                    </h4>
                                    <p class="text-xs text-gray-500">{{ $relatedBlog->formatted_published_date }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-16 bg-gradient-to-r from-blue-600 to-green-600">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto text-center text-white">
            <h2 class="text-3xl font-bold playfair mb-4">Ready for Your Own Adventure?</h2>
            <p class="text-xl mb-8 opacity-90">Let us help you create unforgettable memories in Sri Lanka</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('packages') }}" class="bg-white text-blue-600 hover:bg-gray-100 font-semibold py-3 px-8 rounded-full transition-all duration-300 transform hover:scale-105">
                    Explore Packages
                </a>
                <a href="{{ route('contact') }}" class="border-2 border-white text-white hover:bg-white hover:text-blue-600 font-semibold py-3 px-8 rounded-full transition-all duration-300">
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</section>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.prose {
    color: #374151;
}

.prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
    color: #111827;
    font-weight: 700;
}

.prose h2 {
    font-size: 1.875rem;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.prose h3 {
    font-size: 1.5rem;
    margin-top: 1.5rem;
    margin-bottom: 0.75rem;
}

.prose p {
    margin-bottom: 1.5rem;
    line-height: 1.75;
}

.prose strong {
    font-weight: 600;
    color: #111827;
}
</style>
@endsection
