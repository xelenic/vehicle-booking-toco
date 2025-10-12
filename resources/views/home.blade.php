@extends('layouts.app')

@section('title', 'Ceylon Mirissa - Discover Paradise')
@section('description', 'Experience the magic of Sri Lanka with Ceylon Mirissa. Discover ancient temples, pristine beaches, and unforgettable adventures.')

@push('styles')
<style>
    .custom-marker {
        background: transparent !important;
        border: none !important;
    }
    
    .custom-marker div {
        box-shadow: 0 2px 4px rgba(0,0,0,0.3);
        border: 2px solid white;
    }
    
    .leaflet-popup-content {
        margin: 8px 12px;
        line-height: 1.4;
    }
    
    .leaflet-popup-content h3 {
        margin: 0 0 4px 0;
    }
    
    .leaflet-popup-content h4 {
        margin: 0 0 4px 0;
    }
    
    .leaflet-popup-content p {
        margin: 0;
    }
</style>
@endpush

@section('content')
<!-- Hero Section with Swiper Slider -->
<section id="home" class="relative h-[75vh] overflow-hidden">
    <!-- Swiper Container -->
    <div class="swiper hero-swiper h-full">
        <div class="swiper-wrapper">
            <!-- Slide 1: Sigiriya -->
            <div class="swiper-slide relative">
                <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('slider/sigiriya_rock.jpg') }}')"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-amber-900/70 to-orange-900/70"></div>
                
                <!-- Main Content -->
                <div class="relative z-10 h-full flex items-center justify-center text-center text-white px-4">
                    <div class="max-w-4xl mx-auto">
                        <h1 class="text-5xl md:text-7xl font-bold playfair mb-6 animate-fade-in">
                            Ancient
                            <span class="gradient-text">Sigiriya</span>
                        </h1>
                        <p class="text-xl md:text-2xl mb-8 opacity-90 animate-fade-in-delay">
                            Climb the legendary Lion Rock and discover ancient frescoes
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in-delay-2">
                            <a href="#booking" class="bg-gradient-to-r from-amber-600 to-orange-500 hover:from-amber-700 hover:to-orange-600 text-white font-semibold py-3 px-8 rounded-full transition-all duration-300 transform hover:scale-105">
                                Climb Sigiriya
                            </a>
                            <a href="#packages" class="border-2 border-white text-white hover:bg-white hover:text-amber-600 font-semibold py-3 px-8 rounded-full transition-all duration-300">
                                View Gallery
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Side Package Card -->
                <div class="absolute right-8 top-1/2 transform -translate-y-1/2 z-20 hidden lg:block side-package-card">
                    <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-6 shadow-2xl max-w-sm w-80">
                        <div class="text-center mb-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 playfair">Sigiriya Heritage Tour</h3>
                            <p class="text-gray-600 text-sm">1 Day</p>
                        </div>
                        
                        <div class="space-y-3 mb-4">
                            <div class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                UNESCO World Heritage Site
                            </div>
                            <div class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Ancient frescoes & gardens
                            </div>
                            <div class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Professional guide included
                            </div>
                            <div class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Entrance fees covered
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <span class="text-2xl font-bold text-amber-600">$89</span>
                                <span class="text-gray-500 text-sm">/person</span>
                            </div>
                            <div class="flex items-center">
                                <div class="flex text-yellow-400">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm text-gray-600 ml-1">(4.9)</span>
                            </div>
                        </div>
                        
                        <button class="w-full bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105">
                            Book This Package
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Slide 2: Whale Watching -->
            <div class="swiper-slide relative">
                <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('slider/whale_watiching.jpg') }}')"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-blue-900/70 to-cyan-900/70"></div>
                
                <!-- Main Content -->
                <div class="relative z-10 h-full flex items-center justify-center text-center text-white px-4">
                    <div class="max-w-4xl mx-auto">
                        <h1 class="text-5xl md:text-7xl font-bold playfair mb-6">
                            Whale
                            <span class="gradient-text">Watching</span>
                        </h1>
                        <p class="text-xl md:text-2xl mb-8 opacity-90">
                            Witness magnificent blue whales in their natural habitat
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="#packages" class="bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-700 hover:to-cyan-600 text-white font-semibold py-3 px-8 rounded-full transition-all duration-300 transform hover:scale-105">
                                Book Whale Tour
                            </a>
                            <a href="#about" class="border-2 border-white text-white hover:bg-white hover:text-blue-600 font-semibold py-3 px-8 rounded-full transition-all duration-300">
                                View Videos
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Side Package Card -->
                <div class="absolute right-8 top-1/2 transform -translate-y-1/2 z-20 hidden lg:block side-package-card">
                    <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-6 shadow-2xl max-w-sm w-80">
                        <div class="text-center mb-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 playfair">Whale Watching Adventure</h3>
                            <p class="text-gray-600 text-sm">4 Hours</p>
                        </div>
                        
                        <div class="space-y-3 mb-4">
                            <div class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Blue whale sightings
                            </div>
                            <div class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Dolphin encounters
                            </div>
                            <div class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Professional marine guide
                            </div>
                            <div class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Refreshments included
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <span class="text-2xl font-bold text-blue-600">$65</span>
                                <span class="text-gray-500 text-sm">/person</span>
                            </div>
                            <div class="flex items-center">
                                <div class="flex text-yellow-400">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm text-gray-600 ml-1">(4.8)</span>
                            </div>
                        </div>
                        
                        <button class="w-full bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105">
                            Book This Package
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Slide 3: Ella Rock Hiking -->
            <div class="swiper-slide relative">
                <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('slider/ella_city_tour.jpg') }}')"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-green-900/70 to-emerald-900/70"></div>
                
                <!-- Main Content -->
                <div class="relative z-10 h-full flex items-center justify-center text-center text-white px-4">
                    <div class="max-w-4xl mx-auto">
                        <h1 class="text-5xl md:text-7xl font-bold playfair mb-6">
                            Ella Rock
                            <span class="gradient-text">Hiking</span>
                        </h1>
                        <p class="text-xl md:text-2xl mb-8 opacity-90">
                            Trek through tea plantations to breathtaking mountain views
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="#packages" class="bg-gradient-to-r from-green-600 to-emerald-500 hover:from-green-700 hover:to-emerald-600 text-white font-semibold py-3 px-8 rounded-full transition-all duration-300 transform hover:scale-105">
                                Start Hiking
                            </a>
                            <a href="#contact" class="border-2 border-white text-white hover:bg-white hover:text-green-600 font-semibold py-3 px-8 rounded-full transition-all duration-300">
                                Trail Map
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Side Package Card -->
                <div class="absolute right-8 top-1/2 transform -translate-y-1/2 z-20 hidden lg:block side-package-card">
                    <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-6 shadow-2xl max-w-sm w-80">
                        <div class="text-center mb-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 playfair">Ella Rock Trekking</h3>
                            <p class="text-gray-600 text-sm">6 Hours</p>
                        </div>
                        
                        <div class="space-y-3 mb-4">
                            <div class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Scenic tea plantation views
                            </div>
                            <div class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                360° mountain panorama
                            </div>
                            <div class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Experienced hiking guide
                            </div>
                            <div class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Packed lunch included
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <span class="text-2xl font-bold text-green-600">$45</span>
                                <span class="text-gray-500 text-sm">/person</span>
                            </div>
                            <div class="flex items-center">
                                <div class="flex text-yellow-400">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm text-gray-600 ml-1">(4.6)</span>
                            </div>
                        </div>
                        
                        <button class="w-full bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105">
                            Book This Package
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Slide 4: Kandy Dalada Maligawa -->
            <div class="swiper-slide relative">
                <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('slider/thooth_relic.jpg') }}')"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-purple-900/70 to-indigo-900/70"></div>
                
                <!-- Main Content -->
                <div class="relative z-10 h-full flex items-center justify-center text-center text-white px-4">
                    <div class="max-w-4xl mx-auto">
                        <h1 class="text-5xl md:text-7xl font-bold playfair mb-6">
                            Sacred
                            <span class="gradient-text">Kandy</span>
                        </h1>
                        <p class="text-xl md:text-2xl mb-8 opacity-90">
                            Visit the Temple of the Sacred Tooth Relic
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="#packages" class="bg-gradient-to-r from-purple-600 to-indigo-500 hover:from-purple-700 hover:to-indigo-600 text-white font-semibold py-3 px-8 rounded-full transition-all duration-300 transform hover:scale-105">
                                Temple Tour
                            </a>
                            <a href="#about" class="border-2 border-white text-white hover:bg-white hover:text-purple-600 font-semibold py-3 px-8 rounded-full transition-all duration-300">
                                Cultural Show
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Side Package Card -->
                <div class="absolute right-8 top-1/2 transform -translate-y-1/2 z-20 hidden lg:block side-package-card">
                    <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-6 shadow-2xl max-w-sm w-80">
                        <div class="text-center mb-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-indigo-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 playfair">Kandy Cultural Tour</h3>
                            <p class="text-gray-600 text-sm">1 Day</p>
                        </div>
                        
                        <div class="space-y-3 mb-4">
                            <div class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Temple of the Sacred Tooth
                            </div>
                            <div class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Traditional Kandyan dance
                            </div>
                            <div class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Royal Botanical Gardens
                            </div>
                            <div class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Cultural heritage sites
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <span class="text-2xl font-bold text-purple-600">$75</span>
                                <span class="text-gray-500 text-sm">/person</span>
                            </div>
                            <div class="flex items-center">
                                <div class="flex text-yellow-400">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm text-gray-600 ml-1">(4.9)</span>
                            </div>
                        </div>
                        
                        <button class="w-full bg-gradient-to-r from-purple-500 to-indigo-500 hover:from-purple-600 hover:to-indigo-600 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105">
                            Book This Package
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Slide 5: Arugam Bay Surfing -->
            <div class="swiper-slide relative">
                <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('slider/arugam_bay.jpg') }}')"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-teal-900/70 to-blue-900/70"></div>
                
                <!-- Main Content -->
                <div class="relative z-10 h-full flex items-center justify-center text-center text-white px-4">
                    <div class="max-w-4xl mx-auto">
                        <h1 class="text-5xl md:text-7xl font-bold playfair mb-6">
                            Arugam Bay
                            <span class="gradient-text">Surfing</span>
                        </h1>
                        <p class="text-xl md:text-2xl mb-8 opacity-90">
                            Ride the waves at Sri Lanka's premier surfing destination
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="#packages" class="bg-gradient-to-r from-teal-600 to-blue-500 hover:from-teal-700 hover:to-blue-600 text-white font-semibold py-3 px-8 rounded-full transition-all duration-300 transform hover:scale-105">
                                Surf Lessons
                            </a>
                            <a href="#contact" class="border-2 border-white text-white hover:bg-white hover:text-teal-600 font-semibold py-3 px-8 rounded-full transition-all duration-300">
                                Surf Forecast
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Side Package Card -->
                <div class="absolute right-8 top-1/2 transform -translate-y-1/2 z-20 hidden lg:block side-package-card">
                    <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-6 shadow-2xl max-w-sm w-80">
                        <div class="text-center mb-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 playfair">Surfing Adventure</h3>
                            <p class="text-gray-600 text-sm">3 Days</p>
                        </div>
                        
                        <div class="space-y-3 mb-4">
                            <div class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Professional surf instruction
                            </div>
                            <div class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Equipment rental included
                            </div>
                            <div class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Beachfront accommodation
                            </div>
                            <div class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Multiple surf breaks
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <span class="text-2xl font-bold text-teal-600">$199</span>
                                <span class="text-gray-500 text-sm">/person</span>
                            </div>
                            <div class="flex items-center">
                                <div class="flex text-yellow-400">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm text-gray-600 ml-1">(4.7)</span>
                            </div>
                        </div>
                        
                        <button class="w-full bg-gradient-to-r from-teal-500 to-blue-500 hover:from-teal-600 hover:to-blue-600 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105">
                            Book This Package
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Navigation Buttons -->
        <div class="swiper-button-next hero-swiper-next"></div>
        <div class="swiper-button-prev hero-swiper-prev"></div>
        
        <!-- Pagination -->
        <div class="swiper-pagination hero-swiper-pagination"></div>
    </div>
    
    <!-- Scroll indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>
</section>

<!-- Featured Packages Section -->
<section id="packages" class="py-12 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 playfair mb-4">
                    Featured
                    <span class="gradient-text">Packages</span>
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Discover our most popular tour packages designed to showcase the best of Sri Lanka's natural beauty and cultural heritage.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach($tourPackages as $package)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <div class="relative">
                        <img src="{{ $package['image'] }}" alt="{{ $package['title'] }}" class="w-full h-48 object-cover">
                        <div class="absolute top-3 left-3 text-white px-2 py-1 rounded-full text-xs font-semibold" style="background-color: {{ $package['category'] === 'Cultural' ? '#8B5CF6' : ($package['category'] === 'Wildlife' ? '#10B981' : '#F59E0B') }}">
                            {{ $package['category'] }}
                        </div>
                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-gray-800 px-2 py-1 rounded-full text-xs font-semibold">
                            {{ $package['duration'] }}
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center mb-2">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center mr-2" style="background: linear-gradient(135deg, {{ $package['category'] === 'Cultural' ? '#8B5CF6, #7C3AED' : ($package['category'] === 'Wildlife' ? '#10B981, #059669' : '#F59E0B, #D97706') }})">
                                @if($package['category'] === 'Cultural')
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                @elseif($package['category'] === 'Wildlife')
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                @else
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                @endif
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 playfair">{{ $package['title'] }}</h3>
                                <p class="text-gray-600 text-xs">{{ $package['category'] }} Experience</p>
                            </div>
                        </div>
                        
                        <p class="text-sm text-gray-600 mb-3 leading-relaxed">
                            {{ Str::limit($package['description'], 100) }}
                        </p>
                        
                        <div class="space-y-1 mb-4">
                            @foreach(array_slice($package['highlights'], 0, 2) as $highlight)
                            <div class="flex items-center text-xs text-gray-700">
                                <svg class="w-3 h-3 text-green-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ $highlight }}
                            </div>
                            @endforeach
                        </div>
                        
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <span class="text-xl font-bold" style="color: {{ $package['category'] === 'Cultural' ? '#8B5CF6' : ($package['category'] === 'Wildlife' ? '#10B981' : '#F59E0B') }}">{{ $package['price'] }}</span>
                                @if($package['original_price'])
                                <span class="text-gray-500 text-xs line-through ml-1">{{ $package['original_price'] }}</span>
                                @endif
                                <span class="text-gray-500 text-xs">/person</span>
                            </div>
                            <div class="flex items-center">
                                <div class="flex text-yellow-400">
                                    @for($i = 0; $i < 5; $i++)
                                    <svg class="w-3 h-3" fill="{{ $i < floor($package['rating']) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    @endfor
                                </div>
                                <span class="text-xs text-gray-600 ml-1">({{ $package['rating'] }})</span>
                            </div>
                        </div>
                        
                        <a href="{{ route('package.details', $package['slug']) }}" class="w-full font-medium py-2 px-3 rounded-lg transition-all duration-300 transform hover:scale-105 text-center text-sm" 
                                style="background: linear-gradient(135deg, {{ $package['category'] === 'Cultural' ? '#8B5CF6, #7C3AED' : ($package['category'] === 'Wildlife' ? '#10B981, #059669' : '#F59E0B, #D97706') }})">
                            Book This Package
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Call to Action -->
            <div class="text-center mt-12">
                <h3 class="text-xl font-bold text-gray-900 mb-3">Ready to Explore More?</h3>
                <p class="text-gray-600 mb-6">Discover our complete range of tour packages and create your perfect Sri Lankan adventure!</p>
                <a href="{{ route('packages') }}" class="inline-block bg-gradient-to-r from-blue-600 to-green-600 hover:from-blue-700 hover:to-green-700 text-white px-6 py-3 rounded-full text-base font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                    View All Packages
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Customer Reviews Section -->
<section id="reviews" class="py-12 bg-gradient-to-br from-blue-50 to-green-50">
    <div class="container mx-auto px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 playfair mb-4">
                    What Our
                    <span class="gradient-text">Customers Say</span>
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Don't just take our word for it. Here's what our amazing customers have to say about their experiences with Ceylon Mirissa.
                </p>
            </div>
            
            @if($featuredReviews->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach($featuredReviews as $review)
                <div class="bg-white rounded-xl shadow-md p-4 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <!-- Review Header -->
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-green-500 rounded-full flex items-center justify-center mr-3">
                            <span class="text-white font-bold text-sm">{{ substr($review->customer_name, 0, 1) }}</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">{{ $review->customer_name }}</h4>
                            <p class="text-xs text-gray-600">{{ $review->customer_location }}</p>
                        </div>
                        @if($review->is_verified)
                        <div class="ml-auto">
                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Star Rating -->
                    <div class="flex items-center mb-3">
                        <div class="flex">
                            {!! $review->star_rating !!}
                        </div>
                        <span class="ml-2 text-xs text-gray-600">{{ $review->formatted_review_date }}</span>
                    </div>
                    
                    <!-- Review Text -->
                    <p class="text-sm text-gray-700 mb-3 leading-relaxed">"{{ Str::limit($review->review_text, 120) }}"</p>
                    
                    <!-- Package Info -->
                    <div class="border-t border-gray-100 pt-3">
                        <p class="text-xs text-gray-500">
                            <span class="font-semibold">Tour:</span> {{ Str::limit($review->package->title, 25) }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Overall Rating -->
            <div class="text-center mt-12">
                <div class="bg-white rounded-xl shadow-md p-6 max-w-md mx-auto">
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Overall Rating</h3>
                    <div class="flex items-center justify-center mb-3">
                        <div class="flex text-yellow-400 text-xl mr-3">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                        <span class="text-xl font-bold text-gray-900">4.8</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">Based on {{ \App\Models\Review::approved()->count() }} verified reviews</p>
                    <a href="{{ route('packages') }}" class="inline-block bg-gradient-to-r from-blue-600 to-green-600 hover:from-blue-700 hover:to-green-700 text-white px-6 py-2 rounded-full text-sm font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Read More Reviews
                    </a>
                </div>
            </div>
            @else
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">No Reviews Yet</h3>
                <p class="text-gray-600 mb-8">Be the first to share your experience with Ceylon Mirissa!</p>
                <a href="{{ route('packages') }}" class="inline-block bg-gradient-to-r from-blue-600 to-green-600 hover:from-blue-700 hover:to-green-700 text-white px-8 py-3 rounded-full text-lg font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                    Book Your Adventure
                </a>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- Booking Section -->
<section id="booking" class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 playfair mb-6">
                    Plan Your
                    <span class="gradient-text">Adventure</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Choose your pickup location, destination, and let us show you the perfect route to your Sri Lankan adventure.
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Booking Form -->
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <form id="bookingForm" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="pickupLocation" class="block text-sm font-semibold text-gray-700 mb-2">Pickup Location</label>
                                <select id="pickupLocation" name="pickupLocation" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                                    <option value="">Select pickup location</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="destinationLocation" class="block text-sm font-semibold text-gray-700 mb-2">Destination</label>
                                <select id="destinationLocation" name="destinationLocation" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                                    <option value="">Select destination</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="pickupDate" class="block text-sm font-semibold text-gray-700 mb-2">Pickup Date</label>
                                <input type="date" id="pickupDate" name="pickupDate" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                            </div>
                            <div>
                                <label for="pickupTime" class="block text-sm font-semibold text-gray-700 mb-2">Pickup Time</label>
                                <input type="time" id="pickupTime" name="pickupTime" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="vehicle" class="block text-sm font-semibold text-gray-700 mb-2">Vehicle</label>
                                <select id="vehicle" name="vehicle" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                                    <option value="">Select vehicle</option>
                                    @foreach($vehicles as $vehicle)
                                        <option value="{{ $vehicle['id'] }}" data-pax="{{ $vehicle['pax_count'] }}">
                                            {{ $vehicle['name'] }} - {{ $vehicle['description'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="paxCount" class="block text-sm font-semibold text-gray-700 mb-2">Number of Passengers</label>
                                <input type="number" id="paxCount" name="paxCount" min="1" max="20" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                                <p class="text-xs text-gray-500 mt-1">Maximum capacity will be updated based on selected vehicle</p>
                                <div id="vehicleInfo" class="text-sm text-gray-500 mt-1">Please select a vehicle to see passenger capacity</div>
                                <div id="paxError" class="hidden text-sm text-red-600 mt-1"></div>
                            </div>
                        </div>
                        
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-green-600 hover:from-blue-700 hover:to-green-700 text-white py-4 rounded-lg font-semibold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg mb-3">
                            Plan My Journey
                        </button>
                        
                        <button type="button" onclick="clearRoute()" class="w-full bg-gray-500 hover:bg-gray-600 text-white py-3 rounded-lg font-semibold transition-all duration-300">
                            <i class="fas fa-times mr-2"></i>Clear Route
                        </button>
                    </form>
                </div>
                
                <!-- Map Container -->
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <div id="mapContainer" class="relative">
                        <div id="map" style="height: 500px; width: 100%; border-radius: 12px; overflow: hidden;"></div>
                        
                        <!-- Enhanced Map Legend -->
                        <div class="absolute top-4 right-4 bg-white rounded-lg shadow-lg p-4 z-10 border border-gray-200">
                            <h4 class="font-semibold text-gray-900 mb-3 text-sm flex items-center">
                                <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                                Map Legend
                            </h4>
                            <div class="space-y-2 text-xs">
                                <div class="flex items-center">
                                    <div class="w-4 h-4 bg-red-500 rounded-full mr-2 flex items-center justify-center">
                                        <i class="fas fa-map-marker-alt text-white text-xs"></i>
                                    </div>
                                    <span class="font-medium">Pickup Point</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-4 h-4 bg-blue-500 rounded-lg mr-2 flex items-center justify-center">
                                        <i class="fas fa-home text-white text-xs"></i>
                                    </div>
                                    <span class="font-medium">Destination</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-4 h-4 bg-yellow-500 rounded-full mr-2 flex items-center justify-center">
                                        <i class="fas fa-circle text-white text-xs"></i>
                                </div>
                                    <span class="font-medium">Route Waypoint</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-4 h-4 bg-gray-500 rounded-full mr-2"></div>
                                    <span class="font-medium">Available Locations</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-4 h-1 bg-blue-500 mr-2" style="border-radius: 2px;"></div>
                                    <span class="font-medium">Primary Route</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-4 h-1 bg-green-500 mr-2" style="border-radius: 2px; border: 1px dashed #34a853;"></div>
                                    <span class="font-medium">Alternative Routes</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-4 h-3 bg-white border border-gray-200 rounded mr-2 flex items-center justify-center">
                                        <i class="fas fa-car text-blue-500 text-xs"></i>
                                    </div>
                                    <span class="font-medium">Route Info</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-4 h-4 bg-purple-500 rounded-full mr-2 flex items-center justify-center">
                                        <i class="fas fa-camera text-white text-xs"></i>
                                    </div>
                                    <span class="font-medium">Tourist Attractions</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-4 h-4 bg-green-500 rounded-full mr-2 flex items-center justify-center">
                                        <i class="fas fa-mountain text-white text-xs"></i>
                                    </div>
                                    <span class="font-medium">Mountain Peaks</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-4 h-4 bg-blue-500 rounded-full mr-2 flex items-center justify-center">
                                        <i class="fas fa-suitcase text-white text-xs"></i>
                                    </div>
                                    <span class="font-medium">Travel Hubs</span>
                                </div>
                            </div>
                        </div>
                        
                        <div id="routeInfo" class="mt-4 p-4 bg-gray-50 rounded-lg hidden">
                            <h3 class="font-semibold text-gray-900 mb-3">Route Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="bg-white p-3 rounded-lg">
                                    <div class="flex items-center mb-2">
                                        <i class="fas fa-route text-blue-500 mr-2"></i>
                                        <span class="font-medium text-gray-900">Distance</span>
                                    </div>
                                    <div id="distanceInfo" class="text-sm text-gray-600"></div>
                                </div>
                                <div class="bg-white p-3 rounded-lg">
                                    <div class="flex items-center mb-2">
                                        <i class="fas fa-clock text-green-500 mr-2"></i>
                                        <span class="font-medium text-gray-900">Travel Time</span>
                                    </div>
                                    <div id="timeInfo" class="text-sm text-gray-600"></div>
                                </div>
                            </div>
                            <div class="mt-3 p-3 bg-blue-50 rounded-lg">
                                <div class="flex items-center mb-1">
                                    <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                                    <span class="font-medium text-blue-900">Route Details</span>
                                </div>
                                <div id="routeDetails" class="text-sm text-blue-800"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Reviews Section -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 playfair mb-4">
                    What Our
                    <span class="gradient-text">Travelers Say</span>
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Don't just take our word for it - hear from the amazing travelers who've experienced the magic of Sri Lanka with us.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                <!-- Review 1 -->
                <div class="bg-gray-50 rounded-xl p-4 shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center mb-3">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Sarah" class="w-12 h-12 rounded-full object-cover mr-3">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Sarah Johnson</h3>
                            <p class="text-xs text-gray-600">United Kingdom</p>
                        </div>
                    </div>
                    <div class="flex text-yellow-400 mb-3">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        "The whale watching tour was absolutely breathtaking! Ceylon Mirissa made our trip unforgettable. The guides were knowledgeable and friendly. Highly recommended!"
                    </p>
                </div>
                
                <!-- Review 2 -->
                <div class="bg-gray-50 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="flex items-center mb-6">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Michael" class="w-16 h-16 rounded-full object-cover mr-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Michael Chen</h3>
                            <p class="text-sm text-gray-600">Australia</p>
                        </div>
                    </div>
                    <div class="flex text-yellow-400 mb-4">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        "Climbing Sigiriya Rock was a bucket list experience! The team was professional and made everything smooth. Best tour company in Sri Lanka!"
                    </p>
                </div>
                
                <!-- Review 3 -->
                <div class="bg-gray-50 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="flex items-center mb-6">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Emma" class="w-16 h-16 rounded-full object-cover mr-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Emma Williams</h3>
                            <p class="text-sm text-gray-600">United States</p>
                        </div>
                    </div>
                    <div class="flex text-yellow-400 mb-4">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        "The Ella Rock trekking was amazing! Beautiful scenery and excellent organization. Ceylon Mirissa exceeded all our expectations. Will definitely book again!"
                    </p>
                </div>
                
                <!-- Review 4 -->
                <div class="bg-gray-50 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="flex items-center mb-6">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="David" class="w-16 h-16 rounded-full object-cover mr-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">David Kumar</h3>
                            <p class="text-sm text-gray-600">India</p>
                        </div>
                    </div>
                    <div class="flex text-yellow-400 mb-4">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        "Kandy cultural tour was enlightening! The Temple of the Sacred Tooth was magnificent. Great value for money and wonderful hospitality throughout."
                    </p>
                </div>
                
                <!-- Review 5 -->
                <div class="bg-gray-50 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="flex items-center mb-6">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Jessica" class="w-16 h-16 rounded-full object-cover mr-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Jessica Brown</h3>
                            <p class="text-sm text-gray-600">Canada</p>
                        </div>
                    </div>
                    <div class="flex text-yellow-400 mb-4">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        "Arugam Bay surfing adventure was epic! Perfect waves and great instructors. Ceylon Mirissa made our surf trip a dream come true. Thank you!"
                    </p>
                </div>
                
                <!-- Review 6 -->
                <div class="bg-gray-50 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="flex items-center mb-6">
                        <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Robert" class="w-16 h-16 rounded-full object-cover mr-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Robert Taylor</h3>
                            <p class="text-sm text-gray-600">Germany</p>
                        </div>
                    </div>
                    <div class="flex text-yellow-400 mb-4">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        "Perfect blend of culture and nature! Every detail was well-planned. The team was attentive and made us feel special. Highly recommend Ceylon Mirissa!"
                    </p>
                </div>
            </div>
            
            <!-- Call to Action -->
            <div class="text-center mt-16">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Ready to Create Your Own Story?</h3>
                <p class="text-gray-600 mb-8">Join hundreds of satisfied travelers who've experienced Sri Lanka with us!</p>
                <a href="#booking" class="inline-block bg-gradient-to-r from-blue-600 to-green-600 hover:from-blue-700 hover:to-green-700 text-white px-8 py-4 rounded-full text-lg font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                    Start Your Adventure
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    /* Custom marker animations */
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        60% {
            transform: translateY(-5px);
        }
    }
    
    .google-marker-pickup,
    .google-marker-destination,
    .custom-marker-waypoint {
        animation: bounce 1s ease-in-out;
    }
    
    /* Google Maps style route lines */
    .route-line-primary {
        filter: drop-shadow(0 2px 4px rgba(66, 133, 244, 0.3));
    }
    
    .route-line-alt-0,
    .route-line-alt-1,
    .route-line-alt-2 {
        filter: drop-shadow(0 1px 2px rgba(52, 168, 83, 0.2));
    }
    
    /* Route info box styling */
    .route-info-box {
        background: transparent !important;
        border: none !important;
    }
    
    /* Google Maps style marker shadows */
    .google-marker-pickup,
    .google-marker-destination {
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.3));
    }
    
    /* Route line animations */
    .leaflet-interactive {
        transition: all 0.3s ease;
    }
    
    /* Enhanced map container */
    #map {
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    /* Route info styling */
    #routeInfo {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border: 1px solid #e2e8f0;
    }
    
    /* Enhanced form styling */
    .form-select:focus,
    .form-input:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        border-color: #3b82f6;
    }
</style>
@endpush

@push('scripts')
<!-- Google Maps JavaScript API -->
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key', 'YOUR_API_KEY') }}&libraries=places,directions&callback=initGoogleMap" async defer></script>

<script>
    // Map locations with coordinates from database
    const locations = @json($locationsForMap);
    
    // Create a lookup object for quick access by ID
    const locationLookup = {};
    locations.forEach(location => {
        locationLookup[location.id] = location;
    });
    
    let map;
    let directionsService;
    let directionsRenderer;
    let markers = [];
    
    // Initialize Google Map
    function initGoogleMap() {
        try {
            // Initialize the map centered on Sri Lanka with satellite view
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 7.8731, lng: 80.7718 },
                zoom: 7,
                mapTypeId: google.maps.MapTypeId.HYBRID, // Satellite view with labels
                mapTypeControl: true,
                mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                    position: google.maps.ControlPosition.TOP_RIGHT,
                },
                styles: [
                    {
                        featureType: 'poi',
                        elementType: 'labels',
                        stylers: [{ visibility: 'on' }]
                    },
                    {
                        featureType: 'road',
                        elementType: 'labels',
                        stylers: [{ visibility: 'on' }]
                    }
                ]
            });
            
            // Initialize directions service and renderer
            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer({
                suppressMarkers: true,
                polylineOptions: {
                    strokeColor: '#4285f4',
                    strokeWeight: 6,
                    strokeOpacity: 0.9
                }
            });
            directionsRenderer.setMap(map);
            
            // Add tourist attraction markers
            addTouristAttractions();
            
            // Add markers for all locations from database
            if (locations && locations.length > 0) {
                locations.forEach((location, index) => {
                    const lat = parseFloat(location.latitude);
                    const lng = parseFloat(location.longitude);
                    
                    const marker = new google.maps.Marker({
                        position: { lat: lat, lng: lng },
                        map: map,
                        title: location.name,
                        icon: {
                            url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="12" r="10" fill="#6b7280" stroke="white" stroke-width="2"/>
                                    <circle cx="12" cy="12" r="4" fill="white"/>
                                </svg>
                            `),
                            scaledSize: new google.maps.Size(24, 24),
                            anchor: new google.maps.Point(12, 12)
                        }
                    });
                    
                    // Create info window content
                    let infoContent = `
                        <div class="text-center min-w-[200px]">
                            <h3 class="font-semibold text-gray-900 mb-2">${location.name}</h3>
                    `;
                    
                    if (location.description) {
                        infoContent += `<p class="text-sm text-gray-600 mb-2">${location.description}</p>`;
                    }
                    
                    infoContent += `
                            <p class="text-xs text-gray-500 mb-3">Coordinates: ${lat.toFixed(4)}, ${lng.toFixed(4)}</p>
                            <div class="flex gap-2 justify-center">
                                <button onclick="selectGoogleLocation('${location.id}', 'pickup')" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs transition-colors">Pickup</button>
                                <button onclick="selectGoogleLocation('${location.id}', 'destination')" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs transition-colors">Destination</button>
                        </div>
                        </div>
                    `;
                    
                    const infoWindow = new google.maps.InfoWindow({
                        content: infoContent
                    });
                    
                    marker.addListener('click', () => {
                        infoWindow.open(map, marker);
                    });
                    
                    markers.push(marker);
                });
            } else {
                console.warn('No locations data available');
            }
            
        } catch (error) {
            console.error('Error initializing Google Map:', error);
            const mapContainer = document.getElementById('map');
            if (mapContainer) {
                mapContainer.innerHTML = '<div class="flex items-center justify-center h-full bg-gray-100 rounded-lg"><p class="text-gray-500">Google Maps failed to load. Please check your API key.</p></div>';
            }
        }
    }
    
    // Add tourist attractions based on the image
    function addTouristAttractions() {
        const attractions = [
            {
                name: "Hikkaduwa Beach",
                position: { lat: 6.1444, lng: 80.0969 },
                type: "beach",
                icon: "camera",
                color: "#8b5cf6"
            },
            {
                name: "Goyambokka Beach",
                position: { lat: 5.9494, lng: 80.4561 },
                type: "beach",
                icon: "camera",
                color: "#8b5cf6"
            },
            {
                name: "Udawalawe National Park Safari",
                position: { lat: 6.4333, lng: 80.8833 },
                type: "wildlife",
                icon: "camera",
                color: "#8b5cf6"
            },
            {
                name: "Pidurutalagala",
                position: { lat: 7.0000, lng: 80.7667 },
                type: "mountain",
                icon: "mountain",
                color: "#10b981"
            },
            {
                name: "Ella",
                position: { lat: 6.8667, lng: 81.0333 },
                type: "town",
                icon: "suitcase",
                color: "#3b82f6"
            },
            {
                name: "Bandarawela",
                position: { lat: 6.8333, lng: 80.9833 },
                type: "town",
                icon: "suitcase",
                color: "#3b82f6"
            },
            {
                name: "Yala National Park",
                position: { lat: 6.3728, lng: 81.5242 },
                type: "wildlife",
                icon: "camera",
                color: "#8b5cf6"
            },
            {
                name: "Sinharaja Forest Reserve",
                position: { lat: 6.4167, lng: 80.5000 },
                type: "forest",
                icon: "camera",
                color: "#8b5cf6"
            },
            {
                name: "Sripada Peak Wilderness Sanctuary",
                position: { lat: 6.8167, lng: 80.4833 },
                type: "mountain",
                icon: "mountain",
                color: "#10b981"
            }
        ];
        
        attractions.forEach(attraction => {
            let iconSvg = '';
            
            switch(attraction.icon) {
                case 'camera':
                    iconSvg = `
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="16" cy="16" r="14" fill="${attraction.color}" stroke="white" stroke-width="3"/>
                            <path d="M12 10h8l2 4H10l2-4z" fill="white"/>
                            <circle cx="16" cy="18" r="3" fill="white"/>
                        </svg>
                    `;
                    break;
                case 'mountain':
                    iconSvg = `
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="16" cy="16" r="14" fill="${attraction.color}" stroke="white" stroke-width="3"/>
                            <path d="M8 20l8-8 8 8H8z" fill="white"/>
                        </svg>
                    `;
                    break;
                case 'suitcase':
                    iconSvg = `
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="16" cy="16" r="14" fill="${attraction.color}" stroke="white" stroke-width="3"/>
                            <rect x="10" y="12" width="12" height="8" rx="2" fill="white"/>
                            <path d="M14 12V8h4v4" stroke="white" stroke-width="1"/>
                        </svg>
                    `;
                    break;
            }
            
            const marker = new google.maps.Marker({
                position: attraction.position,
                map: map,
                title: attraction.name,
                icon: {
                    url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(iconSvg),
                    scaledSize: new google.maps.Size(32, 32),
                    anchor: new google.maps.Point(16, 16)
                }
            });
            
            const infoWindow = new google.maps.InfoWindow({
                content: `
                    <div class="text-center min-w-[200px]">
                        <h3 class="font-semibold text-gray-900 mb-2">${attraction.name}</h3>
                        <p class="text-sm text-gray-600 mb-2">${attraction.type.charAt(0).toUpperCase() + attraction.type.slice(1)} Attraction</p>
                        <div class="text-xs text-gray-500 bg-gray-50 p-2 rounded">
                            <div><strong>Type:</strong> Tourist Attraction</div>
                            <div><strong>Coordinates:</strong> ${attraction.position.lat.toFixed(4)}, ${attraction.position.lng.toFixed(4)}</div>
                        </div>
                    </div>
                `
            });
            
            marker.addListener('click', () => {
                infoWindow.open(map, marker);
            });
            
            markers.push(marker);
        });
    }
    
    // Display primary route
    function displayRoute(response, pickupLocation, destinationLocation, travelMode) {
        hideRouteLoading();
        
        // Display the primary route
        directionsRenderer.setDirections(response);
        
        // Update route information
        const route = response.routes[0];
        const leg = route.legs[0];
        
        const distanceInfo = document.getElementById('distanceInfo');
        const timeInfo = document.getElementById('timeInfo');
        const routeDetails = document.getElementById('routeDetails');
        
        if (distanceInfo) {
            distanceInfo.textContent = leg.distance.text;
        }
        if (timeInfo) {
            timeInfo.textContent = leg.duration.text;
        }
        
        // Enhanced route details
        const routeDetailsHtml = `
            <div class="space-y-2">
                <div class="flex items-center">
                    <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                    <span><strong>From:</strong> ${pickupLocation.name}</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-home text-blue-500 mr-2"></i>
                    <span><strong>To:</strong> ${destinationLocation.name}</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-route text-yellow-500 mr-2"></i>
                    <span><strong>Route Type:</strong> ${travelMode.name} Route</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-tachometer-alt text-purple-500 mr-2"></i>
                    <span><strong>Distance:</strong> ${leg.distance.text}</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-clock text-green-500 mr-2"></i>
                    <span><strong>Duration:</strong> ${leg.duration.text}</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-map text-gray-500 mr-2"></i>
                    <span><strong>Map View:</strong> Satellite Hybrid</span>
                </div>
            </div>
        `;
        if (routeDetails) {
            routeDetails.innerHTML = routeDetailsHtml;
        }
        
        document.getElementById('routeInfo').classList.remove('hidden');
        
        // Show success notification
        showRouteNotification(`${travelMode.name} route calculated successfully!`, 'success');
    }
    
    // Display alternative routes
    function displayAlternativeRoutes(allRoutes, pickupLocation, destinationLocation) {
        // Add alternative route markers
        allRoutes.forEach((routeData, index) => {
            if (routeData.travelMode.mode !== google.maps.TravelMode.DRIVING || routeData.routeIndex > 0) {
                const route = routeData.route;
                const leg = route.legs[0];
                
                // Calculate midpoint for info box
                const startLat = leg.start_location.lat();
                const startLng = leg.start_location.lng();
                const endLat = leg.end_location.lat();
                const endLng = leg.end_location.lng();
                const midLat = (startLat + endLat) / 2;
                const midLng = (startLng + endLng) / 2;
                
                // Create info box for alternative route
                const infoBoxIcon = {
                    url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`
                        <svg width="120" height="60" viewBox="0 0 120 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="120" height="60" rx="8" fill="white" stroke="${routeData.travelMode.color}" stroke-width="2"/>
                            <circle cx="20" cy="20" r="8" fill="${routeData.travelMode.color}"/>
                            <text x="35" y="25" font-family="Arial" font-size="12" font-weight="bold" fill="#333">${leg.duration.text}</text>
                            <text x="20" y="45" font-family="Arial" font-size="10" fill="#666">${leg.distance.text}</text>
                            <text x="70" y="45" font-family="Arial" font-size="10" fill="#666">${routeData.travelMode.name}</text>
                        </svg>
                    `),
                    scaledSize: new google.maps.Size(120, 60),
                    anchor: new google.maps.Point(60, 30)
                };
                
                const infoMarker = new google.maps.Marker({
                    position: { lat: midLat, lng: midLng },
                    map: map,
                    icon: infoBoxIcon,
                    title: `${routeData.travelMode.name} Route: ${leg.duration.text}`
                });
                
                // Add click handler to show route details
                const infoWindow = new google.maps.InfoWindow({
                    content: `
                        <div class="text-center min-w-[200px]">
                            <h4 class="font-semibold text-gray-900 mb-2">${routeData.travelMode.name} Route</h4>
                            <div class="space-y-1 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Travel Time:</span>
                                    <span class="font-medium">${leg.duration.text}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Distance:</span>
                                    <span class="font-medium">${leg.distance.text}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Route Type:</span>
                                    <span class="font-medium">${routeData.travelMode.name}</span>
                                </div>
                            </div>
                        </div>
                    `
                });
                
                infoMarker.addListener('click', () => {
                    infoWindow.open(map, infoMarker);
                });
            }
        });
    }
    
    // Draw route using Google Maps Directions API
    function drawGoogleRoute(pickupLocationId, destinationLocationId) {
        try {
            // Show loading state
            showRouteLoading();
            
            const pickupLocation = locationLookup[pickupLocationId];
            const destinationLocation = locationLookup[destinationLocationId];
            
            if (!pickupLocation || !destinationLocation) {
                console.warn('Location not found in lookup');
                hideRouteLoading();
                return;
            }
            
            // Convert coordinates to Google Maps format
            const pickupCoords = { lat: parseFloat(pickupLocation.latitude), lng: parseFloat(pickupLocation.longitude) };
            const destinationCoords = { lat: parseFloat(destinationLocation.latitude), lng: parseFloat(destinationLocation.longitude) };
            
            // Create custom markers for pickup and destination
            const pickupMarker = new google.maps.Marker({
                position: pickupCoords,
                map: map,
                title: `Pickup: ${pickupLocation.name}`,
                icon: {
                    url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="16" cy="16" r="14" fill="#ef4444" stroke="white" stroke-width="3"/>
                            <path d="M16 8L20 16H16V24L12 16H16V8Z" fill="white"/>
                        </svg>
                    `),
                    scaledSize: new google.maps.Size(32, 32),
                    anchor: new google.maps.Point(16, 16)
                }
            });
            
            const destinationMarker = new google.maps.Marker({
                position: destinationCoords,
                map: map,
                title: `Destination: ${destinationLocation.name}`,
                icon: {
                    url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="4" y="8" width="24" height="16" rx="2" fill="#3b82f6" stroke="white" stroke-width="3"/>
                            <path d="M12 16H20M16 12V20" stroke="white" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    `),
                    scaledSize: new google.maps.Size(32, 32),
                    anchor: new google.maps.Point(16, 16)
                }
            });
            
            // Add info windows for markers
            const pickupInfoWindow = new google.maps.InfoWindow({
                content: `
                    <div class="text-center min-w-[200px]">
                        <div class="flex items-center justify-center mb-2">
                            <div class="bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center mr-2">
                                <i class="fas fa-map-marker-alt text-sm"></i>
            </div>
                            <h3 class="font-semibold text-red-600">Pickup Point</h3>
                        </div>
                        <h4 class="font-medium text-gray-900 mb-2">${pickupLocation.name}</h4>
                        ${pickupLocation.description ? `<p class="text-sm text-gray-600 mb-2">${pickupLocation.description}</p>` : ''}
                        <div class="text-xs text-gray-500 bg-gray-50 p-2 rounded">
                            <div><strong>Coordinates:</strong> ${pickupCoords.lat.toFixed(4)}, ${pickupCoords.lng.toFixed(4)}</div>
                        </div>
                    </div>
                `
            });
            
            const destinationInfoWindow = new google.maps.InfoWindow({
                content: `
                    <div class="text-center min-w-[200px]">
                        <div class="flex items-center justify-center mb-2">
                            <div class="bg-blue-500 text-white rounded-full w-8 h-8 flex items-center justify-center mr-2">
                                <i class="fas fa-home text-sm"></i>
            </div>
                            <h3 class="font-semibold text-blue-600">Destination</h3>
                        </div>
                        <h4 class="font-medium text-gray-900 mb-2">${destinationLocation.name}</h4>
                        ${destinationLocation.description ? `<p class="text-sm text-gray-600 mb-2">${destinationLocation.description}</p>` : ''}
                        <div class="text-xs text-gray-500 bg-gray-50 p-2 rounded">
                            <div><strong>Coordinates:</strong> ${destinationCoords.lat.toFixed(4)}, ${destinationCoords.lng.toFixed(4)}</div>
                        </div>
                    </div>
                `
            });
            
            pickupMarker.addListener('click', () => {
                pickupInfoWindow.open(map, pickupMarker);
            });
            
            destinationMarker.addListener('click', () => {
                destinationInfoWindow.open(map, destinationMarker);
            });
            
            // Request directions from Google Maps with multiple travel modes
            const travelModes = [
                { mode: google.maps.TravelMode.DRIVING, name: 'Driving', color: '#4285f4' },
                { mode: google.maps.TravelMode.BICYCLING, name: 'Cycling', color: '#34a853' }
            ];
            
            let routesCalculated = 0;
            const totalRoutes = travelModes.length;
            const allRoutes = [];
            
            travelModes.forEach((travelMode, index) => {
                directionsService.route({
                    origin: pickupCoords,
                    destination: destinationCoords,
                    travelMode: travelMode.mode,
                    provideRouteAlternatives: true
                }, (response, status) => {
                    routesCalculated++;
                    
                    if (status === 'OK') {
                        // Store route data
                        response.routes.forEach((route, routeIndex) => {
                            allRoutes.push({
                                route: route,
                                travelMode: travelMode,
                                routeIndex: routeIndex
                            });
                        });
                        
                        // If this is the first route (driving), display it immediately
                        if (travelMode.mode === google.maps.TravelMode.DRIVING) {
                            displayRoute(response, pickupLocation, destinationLocation, travelMode);
                        }
                    }
                    
                    // When all routes are calculated, show alternatives
                    if (routesCalculated === totalRoutes) {
                        displayAlternativeRoutes(allRoutes, pickupLocation, destinationLocation);
                    }
                });
            });
        
        } catch (error) {
            console.error('Error drawing Google route:', error);
            hideRouteLoading();
            showRouteNotification('Error calculating route. Please try again.', 'error');
        }
    }
    
    // Show loading state for route drawing
    function showRouteLoading() {
        const routeInfo = document.getElementById('routeInfo');
        routeInfo.classList.remove('hidden');
        
        // Create loading overlay instead of replacing content
        let loadingOverlay = document.getElementById('routeLoadingOverlay');
        if (!loadingOverlay) {
            loadingOverlay = document.createElement('div');
            loadingOverlay.id = 'routeLoadingOverlay';
            loadingOverlay.className = 'absolute inset-0 bg-white bg-opacity-90 flex items-center justify-center z-10 rounded-lg';
            loadingOverlay.innerHTML = `
                <div class="flex items-center space-x-3">
                    <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-500"></div>
                    <span class="text-gray-600 font-medium">Calculating route...</span>
                </div>
            `;
            routeInfo.style.position = 'relative';
            routeInfo.appendChild(loadingOverlay);
        }
    }
    
    // Hide loading state
    function hideRouteLoading() {
        const loadingOverlay = document.getElementById('routeLoadingOverlay');
        if (loadingOverlay) {
            loadingOverlay.remove();
        }
    }
    
    // Handle location changes
    function handleLocationChange() {
        const pickupLocationId = document.getElementById('pickupLocation').value;
        const destinationLocationId = document.getElementById('destinationLocation').value;
        
        if (pickupLocationId && destinationLocationId) {
            drawGoogleRoute(pickupLocationId, destinationLocationId);
        }
    }
    
    // Show route notification
    function showRouteNotification(message, type = 'info') {
        const notification = document.createElement('div');
        const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';
        const icon = type === 'success' ? 'fas fa-check-circle' : type === 'error' ? 'fas fa-exclamation-circle' : 'fas fa-info-circle';
        
        notification.className = `fixed top-4 right-4 ${bgColor} text-white px-4 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-300 translate-x-full`;
        notification.innerHTML = `
            <div class="flex items-center space-x-2">
                <i class="${icon}"></i>
                <span class="font-medium">${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 3000);
    }
    
    // Select location from Google Maps info window
    function selectGoogleLocation(locationId, type) {
        const selectElement = document.getElementById(type === 'pickup' ? 'pickupLocation' : 'destinationLocation');
        selectElement.value = locationId;
        
        // Trigger change event to update the map
        selectElement.dispatchEvent(new Event('change'));
        
        // Show success message
        const location = locationLookup[locationId];
        const message = `${location.name} selected as ${type}`;
        showRouteNotification(message, 'success');
    }
    
    // Clear route and reset form
    function clearRoute() {
        // Clear Google Maps directions
        if (directionsRenderer) {
            directionsRenderer.setDirections({ routes: [] });
        }
        
        // Hide route info
        document.getElementById('routeInfo').classList.add('hidden');
        
        // Reset form dropdowns
        document.getElementById('pickupLocation').value = '';
        document.getElementById('destinationLocation').value = '';
        
        // Reset to default view
        if (map) {
            map.setCenter({ lat: 7.8731, lng: 80.7718 });
            map.setZoom(7);
        }
        
        // Show success message
        showRouteNotification('Route cleared successfully', 'info');
    }
    
    // Initialize everything when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Google Maps will initialize via callback
        
        // Set default date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('pickupDate').value = today;
        
        // Set default time to 8:00 AM
        document.getElementById('pickupTime').value = '08:00';
        
        // Add event listeners
        document.getElementById('pickupLocation').addEventListener('change', handleLocationChange);
        document.getElementById('destinationLocation').addEventListener('change', handleLocationChange);
        
        // Handle vehicle selection to update passenger count limit
        document.getElementById('vehicle').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const maxPax = selectedOption.getAttribute('data-pax');
            const paxInput = document.getElementById('paxCount');
            
            if (maxPax) {
                paxInput.max = maxPax;
                paxInput.min = 1;
                paxInput.placeholder = `1-${maxPax} passengers`;
                
                // If current value exceeds new max, adjust it
                if (parseInt(paxInput.value) > parseInt(maxPax)) {
                    paxInput.value = maxPax;
                    showRouteNotification(`Passenger count adjusted to ${maxPax} (vehicle capacity)`, 'info');
                }
                
                // Add visual feedback
                paxInput.style.borderColor = '#10b981';
                paxInput.style.backgroundColor = '#f0fdf4';
                
                // Show vehicle capacity info
                const vehicleInfo = document.getElementById('vehicleInfo');
                if (vehicleInfo) {
                    vehicleInfo.textContent = `Maximum ${maxPax} passengers for selected vehicle`;
                    vehicleInfo.className = 'text-sm text-green-600 mt-1';
                }
            } else {
                paxInput.max = 20;
                paxInput.min = 1;
                paxInput.placeholder = '1-20 passengers';
                paxInput.style.borderColor = '#d1d5db';
                paxInput.style.backgroundColor = '#ffffff';
                
                const vehicleInfo = document.getElementById('vehicleInfo');
                if (vehicleInfo) {
                    vehicleInfo.textContent = 'Please select a vehicle to see passenger capacity';
                    vehicleInfo.className = 'text-sm text-gray-500 mt-1';
                }
            }
        });
        
        // Add real-time validation for passenger input
        document.getElementById('paxCount').addEventListener('input', function() {
            const vehicleSelect = document.getElementById('vehicle');
            const selectedOption = vehicleSelect.options[vehicleSelect.selectedIndex];
            const maxPax = selectedOption.getAttribute('data-pax');
            const currentValue = parseInt(this.value);
            
            if (maxPax && currentValue > parseInt(maxPax)) {
                this.style.borderColor = '#ef4444';
                this.style.backgroundColor = '#fef2f2';
                
                // Show error message
                const errorMsg = document.getElementById('paxError');
                if (errorMsg) {
                    errorMsg.textContent = `Maximum ${maxPax} passengers allowed for selected vehicle`;
                    errorMsg.className = 'text-sm text-red-600 mt-1';
                }
            } else if (maxPax && currentValue <= parseInt(maxPax) && currentValue >= 1) {
                this.style.borderColor = '#10b981';
                this.style.backgroundColor = '#f0fdf4';
                
                // Hide error message
                const errorMsg = document.getElementById('paxError');
                if (errorMsg) {
                    errorMsg.textContent = '';
                    errorMsg.className = 'hidden';
                }
            } else {
                this.style.borderColor = '#d1d5db';
                this.style.backgroundColor = '#ffffff';
            }
        });
        
        // Prevent same location selection for pickup and destination
        const pickupSelect = document.getElementById('pickupLocation');
        const destinationSelect = document.getElementById('destinationLocation');
        
        function updateDestinationOptions() {
            const selectedPickup = pickupSelect.value;
            const options = destinationSelect.querySelectorAll('option');
            
            options.forEach(option => {
                if (option.value === '') {
                    option.disabled = false;
                } else if (option.value === selectedPickup) {
                    option.disabled = true;
                    option.style.display = 'none';
                } else {
                    option.disabled = false;
                    option.style.display = 'block';
                }
            });
            
            // If destination is same as pickup, reset it
            if (destinationSelect.value === selectedPickup) {
                destinationSelect.value = '';
            }
        }
        
        function updatePickupOptions() {
            const selectedDestination = destinationSelect.value;
            const options = pickupSelect.querySelectorAll('option');
            
            options.forEach(option => {
                if (option.value === '') {
                    option.disabled = false;
                } else if (option.value === selectedDestination) {
                    option.disabled = true;
                    option.style.display = 'none';
                } else {
                    option.disabled = false;
                    option.style.display = 'block';
                }
            });
            
            // If pickup is same as destination, reset it
            if (pickupSelect.value === selectedDestination) {
                pickupSelect.value = '';
            }
        }
        
        pickupSelect.addEventListener('change', updateDestinationOptions);
        destinationSelect.addEventListener('change', updatePickupOptions);
        
        // Handle form submission
        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);
            
            // Validate passenger count against vehicle capacity
            const vehicleSelect = document.getElementById('vehicle');
            const selectedOption = vehicleSelect.options[vehicleSelect.selectedIndex];
            const maxPax = selectedOption.getAttribute('data-pax');
            const passengerCount = parseInt(data.paxCount);
            
            if (maxPax && passengerCount > parseInt(maxPax)) {
                showRouteNotification(`Error: Maximum ${maxPax} passengers allowed for selected vehicle`, 'error');
                document.getElementById('paxCount').focus();
                return false;
            }
            
            if (data.pickupLocation && data.destinationLocation) {
                // Get vehicle name for display
                const vehicleName = selectedOption.textContent;
                
                alert(`Booking request submitted!\n\nPickup: ${data.pickupLocation}\nDestination: ${data.destinationLocation}\nDate: ${data.pickupDate}\nTime: ${data.pickupTime}\nVehicle: ${vehicleName}\nPassengers: ${data.paxCount}`);
                
                // Reset form
                this.reset();
                document.getElementById('pickupDate').value = today;
                document.getElementById('pickupTime').value = '08:00';
                document.getElementById('routeInfo').classList.add('hidden');
                
                // Clear Google Maps directions
                if (directionsRenderer) {
                    directionsRenderer.setDirections({ routes: [] });
                }
                
                // Reset map view
                if (map) {
                    map.setCenter({ lat: 7.8731, lng: 80.7718 });
                    map.setZoom(7);
                }
                
                showRouteNotification('Booking submitted successfully!', 'success');
            } else {
                showRouteNotification('Please select both pickup and destination locations', 'error');
            }
        });
    });
    
    // Initialize Swiper
    function initializeSwiper() {
        const heroSwiper = new Swiper('.hero-swiper', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            speed: 1000,
            navigation: {
                nextEl: '.hero-swiper-next',
                prevEl: '.hero-swiper-prev',
            },
            pagination: {
                el: '.hero-swiper-pagination',
                clickable: true,
            },
            on: {
                slideChange: function () {
                    // Re-apply animations to new slide content
                    const activeSlide = this.slides[this.activeIndex];
                    const animatedElements = activeSlide.querySelectorAll('.animate-fade-in, .animate-fade-in-delay, .animate-fade-in-delay-2');
                    animatedElements.forEach(el => {
                        el.style.animation = 'none';
                        el.offsetHeight; // Trigger reflow
                        el.style.animation = null;
                    });
                }
            }
        });
    }
    
    // Initialize Swiper when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        initializeSwiper();
        
        // Add event listeners to package booking buttons
        document.querySelectorAll('.side-package-card button').forEach(button => {
            button.addEventListener('click', function() {
                const packageCard = this.closest('.side-package-card');
                const packageName = packageCard.querySelector('h3').textContent;
                const packagePrice = packageCard.querySelector('.text-2xl').textContent;
                
                alert(`Package Selected!\n\n${packageName}\nPrice: ${packagePrice}\n\nWe'll contact you soon to confirm your booking!`);
            });
        });
        
        // Add event listeners to featured package booking buttons
        document.querySelectorAll('.package-book-btn').forEach(button => {
            button.addEventListener('click', function() {
                const packageName = this.getAttribute('data-package');
                const packagePrice = this.getAttribute('data-price');
                
                alert(`Package Selected!\n\n${packageName}\nPrice: ${packagePrice}\n\nWe'll contact you soon to confirm your booking!`);
            });
        });
    });
</script>
@endpush
