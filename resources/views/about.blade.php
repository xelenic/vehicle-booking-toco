@extends('layouts.app')

@section('title', 'About Us - Ceylon Mirissa')
@section('description', 'Learn about Ceylon Mirissa, your trusted partner for authentic Sri Lankan travel experiences. Discover our story, mission, and commitment to showcasing the beauty of Sri Lanka.')

@section('content')
<!-- Hero Section -->
<section class="relative h-[50vh] flex items-center justify-center overflow-hidden pt-20">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/70 to-green-900/70"></div>
    </div>
    
    <div class="relative z-10 text-center text-white px-4">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl md:text-4xl font-bold playfair mb-4 animate-fade-in">
                About
                <span class="gradient-text">Ceylon Mirissa</span>
            </h1>
            <p class="text-lg md:text-xl mb-6 opacity-90 animate-fade-in-delay">
                Your trusted partner in discovering the authentic beauty of Sri Lanka
            </p>
            <div class="animate-fade-in-delay-2">
                <a href="#our-story" class="bg-gradient-to-r from-blue-600 to-green-500 hover:from-blue-700 hover:to-green-600 text-white px-6 py-3 rounded-full text-sm font-semibold transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                    Discover Our Story
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Our Story Section -->
<section id="our-story" class="py-12 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 playfair mb-4">
                    Our Story
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Born from a deep love for Sri Lanka's rich heritage and natural beauty, Ceylon Mirissa has been creating unforgettable travel experiences since our founding.
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center mb-16">
                <div class="space-y-4">
                    <h3 class="text-2xl font-bold text-gray-900 playfair">A Journey of Discovery</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        Founded by passionate travelers who fell in love with Sri Lanka's diverse landscapes, ancient temples, and warm hospitality, Ceylon Mirissa began as a dream to share this paradise with the world.
                    </p>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        From the misty mountains of Ella to the golden beaches of Mirissa, from the ancient frescoes of Sigiriya to the sacred temples of Kandy, we curate experiences that showcase the very best of this incredible island nation.
                    </p>
                    <div class="flex items-center space-x-3">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-green-500 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-semibold text-gray-900">Authentic Experiences</h4>
                            <p class="text-gray-600">Handpicked destinations and local insights</p>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Sri Lankan landscape" class="rounded-2xl shadow-2xl">
                    <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-gradient-to-r from-blue-500 to-green-500 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Values Section -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 playfair mb-4">
                    Our Mission & Values
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    We are committed to providing exceptional travel experiences while preserving Sri Lanka's natural beauty and cultural heritage.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Mission -->
                <div class="text-center p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 playfair mb-3">Our Mission</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        To showcase the authentic beauty of Sri Lanka through carefully curated experiences that connect travelers with the island's rich culture, stunning landscapes, and warm people.
                    </p>
                </div>
                
                <!-- Vision -->
                <div class="text-center p-4 bg-gradient-to-br from-green-50 to-green-100 rounded-xl">
                    <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 playfair mb-3">Our Vision</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        To be the leading travel company that helps visitors discover the hidden gems of Sri Lanka while promoting sustainable tourism and supporting local communities.
                    </p>
                </div>
                
                <!-- Values -->
                <div class="text-center p-4 bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl">
                    <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 playfair mb-3">Our Values</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        Authenticity, sustainability, and exceptional service guide everything we do. We believe in creating meaningful connections between travelers and the places they visit.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 playfair mb-4">
                    Meet Our Team
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Our passionate team of local experts and travel enthusiasts are dedicated to making your Sri Lankan adventure unforgettable.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Team Member 1 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Team member" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-900 playfair mb-2">Rajesh Perera</h3>
                        <p class="text-blue-600 font-semibold mb-3 text-sm">Founder & CEO</p>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            A native of Kandy with over 15 years of experience in tourism, Rajesh founded Ceylon Mirissa to share his love for Sri Lanka's cultural heritage.
                        </p>
                    </div>
                </div>
                
                <!-- Team Member 2 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Team member" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-bold text-gray-900 playfair mb-2">Priya Fernando</h3>
                        <p class="text-green-600 font-semibold mb-3">Head of Operations</p>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Born in Mirissa, Priya ensures every detail of your journey is perfect. Her expertise in wildlife and marine conservation adds depth to our eco-tours.
                        </p>
                    </div>
                </div>
                
                <!-- Team Member 3 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Team member" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-bold text-gray-900 playfair mb-2">Kumar Silva</h3>
                        <p class="text-purple-600 font-semibold mb-3">Lead Guide</p>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            With extensive knowledge of Sri Lanka's ancient sites and hiking trails, Kumar brings history and adventure to life for our guests.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 playfair mb-4">
                    Why Choose Ceylon Mirissa?
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    We go beyond typical tourism to create meaningful, authentic experiences that connect you with the heart of Sri Lanka.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div class="flex items-start space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Local Expertise</h3>
                            <p class="text-gray-600 text-sm">Our team consists of native Sri Lankans who know the hidden gems and best-kept secrets of the island.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Sustainable Tourism</h3>
                            <p class="text-gray-600">We're committed to eco-friendly practices and supporting local communities through responsible tourism.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">24/7 Support</h3>
                            <p class="text-gray-600">Round-the-clock assistance ensures your journey is smooth and worry-free from start to finish.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column -->
                <div class="space-y-6">
                    <div class="flex items-start space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Customized Experiences</h3>
                            <p class="text-gray-600">Every tour is tailored to your interests, pace, and preferences for a truly personal adventure.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-teal-500 to-teal-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Safety First</h3>
                            <p class="text-gray-600">Your safety is our top priority with certified guides and comprehensive insurance coverage.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-red-500 to-red-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Best Value</h3>
                            <p class="text-gray-600">Competitive pricing with no hidden fees, ensuring you get exceptional value for your investment.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-12 bg-gradient-to-r from-blue-600 to-green-600">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto text-center text-white">
            <h2 class="text-3xl md:text-4xl font-bold playfair mb-4">
                Ready to Discover Sri Lanka?
            </h2>
            <p class="text-lg mb-6 opacity-90">
                Join thousands of satisfied travelers who have experienced the magic of Sri Lanka with Ceylon Mirissa.
            </p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('contact') }}" class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-3 rounded-full text-sm font-semibold transition-all duration-300 transform hover:scale-105">
                    Get in Touch
                </a>
                <a href="{{ route('home') }}#packages" class="border-2 border-white text-white hover:bg-white hover:text-blue-600 px-6 py-3 rounded-full text-sm font-semibold transition-all duration-300 transform hover:scale-105">
                    View Packages
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
