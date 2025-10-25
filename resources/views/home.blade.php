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
                                        <option value="{{ $vehicle['id'] }}" 
                                                data-pax="{{ $vehicle['pax_count'] }}"
                                                data-pricing-type="{{ $vehicle['effective_pricing_type'] }}"
                                                data-per-km-price="{{ $vehicle['per_km_price'] }}"
                                                data-first-km-price="{{ $vehicle['price_first_km'] }}"
                                                data-per-100m-price="{{ $vehicle['price_per_100m_after'] }}">
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
                        
                        <!-- Price Display Section -->
                        <div id="priceDisplay" class="hidden bg-gradient-to-r from-green-50 to-blue-50 rounded-lg p-4 border border-green-200">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-lg font-semibold text-gray-900">Estimated Price</h3>
                                <div id="totalPrice" class="text-2xl font-bold text-green-600"></div>
                            </div>
                            <div id="priceBreakdown" class="text-sm text-gray-600 space-y-1"></div>
                            <div class="mt-3 pt-3 border-t border-green-200">
                                <div class="flex items-center text-xs text-gray-500">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    <span>Price calculated based on distance and selected vehicle</span>
                                </div>
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
                        
                        <div id="routeInfo" class="mt-4 p-5 bg-gradient-to-br from-blue-50 via-green-50 to-blue-50 rounded-xl shadow-lg border border-blue-200 hidden animate-fade-in">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                    <i class="fas fa-route text-blue-600 mr-2"></i>
                                    Route Information
                                </h3>
                                <button onclick="document.getElementById('routeInfo').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 transition-colors duration-300">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div class="bg-white p-4 rounded-lg shadow-sm border border-blue-100 hover:shadow-md transition-shadow duration-300">
                                    <div class="flex items-center mb-2">
                                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center mr-2">
                                            <i class="fas fa-route text-white text-sm"></i>
                                        </div>
                                        <span class="font-semibold text-gray-900">Distance</span>
                                    </div>
                                    <div id="distanceInfo" class="text-base font-bold text-blue-600 mt-1"></div>
                                </div>
                                <div class="bg-white p-4 rounded-lg shadow-sm border border-green-100 hover:shadow-md transition-shadow duration-300">
                                    <div class="flex items-center mb-2">
                                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mr-2">
                                            <i class="fas fa-clock text-white text-sm"></i>
                                        </div>
                                        <span class="font-semibold text-gray-900">Travel Time</span>
                                    </div>
                                    <div id="timeInfo" class="text-base font-bold text-green-600 mt-1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

<!-- Booking Modal -->
<div id="bookingModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black bg-opacity-50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-blue-600 to-green-600 text-white p-6 rounded-t-2xl">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold">Complete Your Booking</h2>
                    <p class="text-sm opacity-90 mt-1">Provide your details to confirm your travel order</p>
                </div>
                <button onclick="closeBookingModal()" class="text-white hover:text-gray-200 transition-colors duration-300 p-2 rounded-full hover:bg-white hover:bg-opacity-20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            <!-- Booking Summary -->
            <div class="bg-blue-50 rounded-lg p-4 mb-6">
                <h3 class="font-semibold text-gray-900 mb-2">Booking Summary</h3>
                <div id="bookingSummary" class="text-sm text-gray-600 space-y-1">
                    <!-- Will be populated by JavaScript -->
                </div>
            </div>

            <!-- Booking Form -->
            <form id="finalBookingForm" class="space-y-4">
                @auth
                <!-- Logged-in user fields (pre-filled and read-only) -->
                <div class="bg-blue-50 rounded-lg p-4 mb-4">
                    <div class="flex items-center">
                        <i class="fas fa-user-circle text-blue-600 mr-2"></i>
                        <span class="text-sm font-medium text-blue-600">You are logged in as: {{ Auth::user()->email }}</span>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="fullName" class="block text-sm font-semibold text-gray-700 mb-2">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="fullName" name="fullName" value="{{ Auth::user()->name }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50" readonly>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50" readonly>
                    </div>
                </div>
                <div>
                    <label for="phoneNumber" class="block text-sm font-semibold text-gray-700 mb-2">
                        Phone Number <span class="text-red-500">*</span>
                    </label>
                    <input type="tel" id="phoneNumber" name="phoneNumber" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <input type="hidden" name="password" value="">
                </div>
                @else
                <!-- Guest user fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="fullName" class="block text-sm font-semibold text-gray-700 mb-2">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="fullName" name="fullName" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="phoneNumber" class="block text-sm font-semibold text-gray-700 mb-2">
                            Phone Number <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" id="phoneNumber" name="phoneNumber" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div id="loginSection">
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="password" name="password" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <p id="passwordHint" class="text-xs text-gray-500 mt-1">Enter your password to login (if existing user) or create a new password (if new user)</p>
                        <div id="userStatus" class="mt-2 hidden">
                            <span id="userStatusText" class="text-sm font-medium"></span>
                        </div>
                    </div>
                </div>
                @endauth

                <div>
                    <label for="specialRequirements" class="block text-sm font-semibold text-gray-700 mb-2">
                        Special Requirements or Notes
                    </label>
                    <textarea id="specialRequirements" name="specialRequirements" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Any special requirements, dietary restrictions, accessibility needs, etc."></textarea>
                </div>

                <div class="flex items-center pt-4">
                    <input type="checkbox" id="terms" name="terms" required class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500">
                    <label for="terms" class="ml-2 text-sm text-gray-600">
                        I agree to the <a href="/terms" class="text-blue-600 hover:underline">Terms and Conditions</a> and <a href="/privacy" class="text-blue-600 hover:underline">Privacy Policy</a>
                    </label>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="border-t border-gray-200 p-6 bg-gray-50 rounded-b-2xl">
            <div class="flex justify-between items-center">
                <button onclick="closeBookingModal()" class="px-6 py-3 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-all duration-300">
                    Cancel
                </button>
                <button onclick="submitFinalBooking()" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-green-600 hover:from-blue-700 hover:to-green-700 text-white rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                    Confirm Booking
                </button>
            </div>
        </div>
    </div>
</div>

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
    
    /* Reverse spin animation for loading */
    @keyframes spin-reverse {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(-360deg);
        }
    }
    
    .animate-reverse {
        animation: spin-reverse 1s linear infinite;
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
        
        // Show Route Details section
        document.getElementById('routeInfo').classList.remove('hidden');
        
        // Calculate and display price with error handling
        if (leg && leg.distance && leg.distance.value) {
            console.log('Calculating price with distance:', leg.distance.value);
            
            // Check if a vehicle is selected
            const vehicleSelect = document.getElementById('vehicle');
            const selectedVehicleId = vehicleSelect ? vehicleSelect.value : '';
            
            if (selectedVehicleId) {
                // Vehicle is selected, calculate price
                calculatePrice(pickupLocation.id, destinationLocation.id, leg.distance.value);
            } else {
                // No vehicle selected yet
                console.log('No vehicle selected yet - price calculation will trigger when vehicle is selected');
            }
        } else {
            console.error('Invalid distance data from route:', leg);
            showRouteNotification('Route calculated but unable to get distance. Please try again.', 'warning');
        }
        
        // Show success notification
        showRouteNotification(`${travelMode.name} route calculated successfully!`, 'success');
    }
    
    // Calculate price based on distance and selected vehicle
    function calculatePrice(pickupLocationId, destinationLocationId, distanceInMeters) {
        const vehicleSelect = document.getElementById('vehicle');
        const selectedVehicleId = vehicleSelect.value;
        
        if (!selectedVehicleId) {
            // Hide price display if no vehicle selected
            document.getElementById('priceDisplay').classList.add('hidden');
            return;
        }
        
        // Convert meters to kilometers
        const distanceInKm = distanceInMeters / 1000;
        
        // Store the distance for potential recalculation
        window.lastCalculatedDistance = distanceInMeters;
        
        // Show loading state for price calculation
        const priceDisplay = document.getElementById('priceDisplay');
        priceDisplay.classList.remove('hidden');
        priceDisplay.innerHTML = `
            <div class="flex items-center justify-center py-4">
                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-green-500 mr-3"></div>
                <span class="text-gray-600 font-medium">Calculating price...</span>
            </div>
        `;
        
        // Make API request to calculate price using GET request
        const params = new URLSearchParams({
            pickup_location_id: pickupLocationId,
            destination_location_id: destinationLocationId,
            vehicle_id: selectedVehicleId,
            distance: distanceInKm
        });
        
        // Add timeout to fetch request
        const timeoutId = setTimeout(() => {
            console.error('Price calculation request timed out');
            priceDisplay.innerHTML = `
                <div class="text-center py-4">
                    <div class="text-yellow-600 mb-2">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                    <p class="text-sm text-gray-600">Calculation is taking longer than expected</p>
                    <p class="text-xs text-gray-500 mt-1">Please wait...</p>
                </div>
            `;
        }, 10000); // 10 second timeout
        
        fetch(`/vehicle-booking/calculate-price?${params}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => {
            clearTimeout(timeoutId);
            console.log('Response status:', response.status);
            console.log('Response headers:', response.headers);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            return response.json();
        })
        .then(data => {
            console.log('Price calculation response:', data);
            
            if (data && data.success) {
                if (data.data) {
                    displayPrice(data.data);
                } else {
                    throw new Error('Invalid response data');
                }
            } else {
                throw new Error(data.message || 'Failed to calculate price');
            }
        })
        .catch(error => {
            clearTimeout(timeoutId);
            console.error('Price calculation error:', error);
            console.error('Error details:', {
                message: error.message,
                stack: error.stack,
                url: `/vehicle-booking/calculate-price?${params}`
            });
            
            priceDisplay.innerHTML = `
                <div class="text-center py-4">
                    <div class="text-red-600 mb-2">
                        <i class="fas fa-exclamation-triangle text-xl"></i>
                    </div>
                    <p class="text-sm text-gray-600">Unable to calculate price</p>
                    <p class="text-xs text-gray-500 mt-1">Error: ${error.message}</p>
                    <button onclick="calculatePrice('${pickupLocationId}', '${destinationLocationId}', ${distanceInMeters})" 
                        class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Retry
                    </button>
                </div>
            `;
        });
    }
    
    // Show vehicle pricing information when vehicle is selected
    function showVehiclePricing(selectedOption) {
        console.log('showVehiclePricing called with:', selectedOption);
        
        // Check if selectedOption exists
        if (!selectedOption) {
            console.error('selectedOption is null or undefined');
            return;
        }
        
        const vehicleId = selectedOption.value;
        const vehicleName = selectedOption.textContent.split(' - ')[0];
        
        // Get pricing data from option attributes
        const pricingType = selectedOption.getAttribute('data-pricing-type');
        const perKmPrice = selectedOption.getAttribute('data-per-km-price');
        const firstKmPrice = selectedOption.getAttribute('data-first-km-price');
        const per100mPrice = selectedOption.getAttribute('data-per-100m-price');
        
        console.log('Vehicle pricing data:', {
            vehicleId,
            vehicleName,
            pricingType,
            perKmPrice,
            firstKmPrice,
            per100mPrice
        });
        
        const priceDisplay = document.getElementById('priceDisplay');
        
        // Check if priceDisplay element exists
        if (!priceDisplay) {
            console.error('priceDisplay element not found');
            return;
        }
        
        priceDisplay.classList.remove('hidden');
        
        // Create pricing display based on vehicle pricing type
        let pricingHtml = '';
        
        if (pricingType === 'first_km_meter') {
            pricingHtml = `
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-lg font-semibold text-gray-900">${vehicleName} Pricing</h3>
                    <div class="text-sm text-gray-600">First KM + Per 100m</div>
                </div>
                <div class="text-sm text-gray-600 space-y-2">
                    <div class="flex justify-between items-center bg-blue-50 p-2 rounded">
                        <span class="font-medium">First 1km:</span>
                        <span class="font-semibold text-blue-600">LKR ${parseFloat(firstKmPrice || 0).toFixed(2)}</span>
                    </div>
                    <div class="flex justify-between items-center bg-green-50 p-2 rounded">
                        <span class="font-medium">Per 100m after:</span>
                        <span class="font-semibold text-green-600">LKR ${parseFloat(per100mPrice || 0).toFixed(2)}</span>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-t border-gray-200">
                    <div class="flex items-center text-xs text-gray-500">
                        <i class="fas fa-info-circle mr-1"></i>
                        <span>Select pickup and destination to see total price</span>
                    </div>
                </div>
            `;
        } else {
            pricingHtml = `
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-lg font-semibold text-gray-900">${vehicleName} Pricing</h3>
                    <div class="text-sm text-gray-600">Per Kilometer</div>
                </div>
                <div class="text-sm text-gray-600 space-y-2">
                    <div class="flex justify-between items-center bg-blue-50 p-2 rounded">
                        <span class="font-medium">Per kilometer:</span>
                        <span class="font-semibold text-blue-600">LKR ${parseFloat(perKmPrice || 0).toFixed(2)}</span>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-t border-gray-200">
                    <div class="flex items-center text-xs text-gray-500">
                        <i class="fas fa-info-circle mr-1"></i>
                        <span>Select pickup and destination to see total price</span>
                    </div>
                </div>
            `;
        }
        
        priceDisplay.innerHTML = pricingHtml;
        
        // Add animation
        priceDisplay.style.transform = 'scale(1.02)';
        setTimeout(() => {
            priceDisplay.style.transform = 'scale(1)';
        }, 200);
    }
    
    // Display calculated price
    function displayPrice(priceData) {
        const priceDisplay = document.getElementById('priceDisplay');
        const totalPrice = document.getElementById('totalPrice');
        const priceBreakdown = document.getElementById('priceBreakdown');
        
        // Check if priceDisplay element exists
        if (!priceDisplay) {
            console.error('priceDisplay element not found');
            return;
        }
        
        // Generate price breakdown HTML
        const breakdownHtml = priceData.price_breakdown.map(item => 
            `<div class="flex justify-between">
                <span>${item}</span>
            </div>`
        ).join('');
        
        // Show the price display with animation
        priceDisplay.innerHTML = `
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-semibold text-gray-900">Estimated Price</h3>
                <div class="text-2xl font-bold text-green-600">${priceData.formatted_price}</div>
            </div>
            <div class="text-sm text-gray-600 space-y-1">
                ${breakdownHtml}
            </div>
            <div class="mt-3 pt-3 border-t border-green-200">
                <div class="flex items-center text-xs text-gray-500">
                    <i class="fas fa-info-circle mr-1"></i>
                    <span>Price calculated based on distance and selected vehicle</span>
                </div>
            </div>
        `;
        
        // Add success animation
        priceDisplay.style.transform = 'scale(1.02)';
        setTimeout(() => {
            priceDisplay.style.transform = 'scale(1)';
        }, 200);
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
        
        // Create improved loading overlay
        let loadingOverlay = document.getElementById('routeLoadingOverlay');
        if (!loadingOverlay) {
            loadingOverlay = document.createElement('div');
            loadingOverlay.id = 'routeLoadingOverlay';
            loadingOverlay.className = 'bg-gradient-to-br from-blue-50 via-green-50 to-blue-50 p-8 rounded-xl flex items-center justify-center';
            loadingOverlay.innerHTML = `
                <div class="flex flex-col items-center space-y-4 animate-pulse">
                    <div class="relative">
                        <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-blue-500"></div>
                        <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-green-500 absolute top-0 left-0 animate-reverse"></div>
                    </div>
                    <div class="text-center">
                        <h4 class="text-lg font-semibold text-gray-800 mb-1">Calculating Route</h4>
                        <p class="text-sm text-gray-600">Finding the best path for your journey...</p>
                    </div>
                    <div class="flex space-x-2 mt-2">
                        <div class="w-2 h-2 bg-blue-500 rounded-full animate-bounce" style="animation-delay: 0ms;"></div>
                        <div class="w-2 h-2 bg-green-500 rounded-full animate-bounce" style="animation-delay: 150ms;"></div>
                        <div class="w-2 h-2 bg-blue-500 rounded-full animate-bounce" style="animation-delay: 300ms;"></div>
                    </div>
                </div>
            `;
            routeInfo.appendChild(loadingOverlay);
        } else {
            loadingOverlay.classList.remove('hidden');
        }
    }
    
    // Hide loading state
    function hideRouteLoading() {
        const loadingOverlay = document.getElementById('routeLoadingOverlay');
        if (loadingOverlay) {
            loadingOverlay.classList.add('hidden');
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
        
        // Hide price display
        document.getElementById('priceDisplay').classList.add('hidden');
        
        // Reset form dropdowns
        document.getElementById('pickupLocation').value = '';
        document.getElementById('destinationLocation').value = '';
        
        // Clear stored distance
        window.lastCalculatedDistance = null;
        
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
        // Make vehicles data available to JavaScript
        window.vehiclesData = @json($vehicles);
        
        // Google Maps will initialize via callback
        
        // Set default date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('pickupDate').value = today;
        
        // Set default time to 8:00 AM
        document.getElementById('pickupTime').value = '08:00';
        
        // Add event listeners
        document.getElementById('pickupLocation').addEventListener('change', handleLocationChange);
        document.getElementById('destinationLocation').addEventListener('change', handleLocationChange);
        
        // Handle vehicle selection to update passenger count limit and show pricing
        document.getElementById('vehicle').addEventListener('change', function() {
            console.log('Vehicle change event triggered');
            const selectedOption = this.options[this.selectedIndex];
            console.log('Selected option:', selectedOption);
            
            if (!selectedOption) {
                console.error('No option selected');
                return;
            }
            
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
                
                // Show vehicle pricing information immediately
                showVehiclePricing(selectedOption);
                
                // Recalculate price if route is already displayed
                const pickupLocationId = document.getElementById('pickupLocation').value;
                const destinationLocationId = document.getElementById('destinationLocation').value;
                
                // Check if route is displayed by checking if routeInfo is visible
                const routeInfo = document.getElementById('routeInfo');
                const isRouteDisplayed = routeInfo && !routeInfo.classList.contains('hidden');
                
                if (pickupLocationId && destinationLocationId) {
                    if (window.lastCalculatedDistance && isRouteDisplayed) {
                        // Calculate price using stored distance
                        console.log('Recalculating price after vehicle change');
                        calculatePrice(pickupLocationId, destinationLocationId, window.lastCalculatedDistance);
                    } else {
                        // Check if there's a route info but not calculated yet
                        console.log('Waiting for route distance to be calculated');
                    }
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
                
                // Hide pricing when no vehicle selected
                document.getElementById('priceDisplay').classList.add('hidden');
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
                
                // Prepare booking data
                const bookingData = {
                    pickupLocation: data.pickupLocation,
                    destinationLocation: data.destinationLocation,
                    pickupDate: data.pickupDate,
                    pickupTime: data.pickupTime,
                    vehicle: vehicleName,
                    vehicleId: data.vehicle,
                    passengers: data.paxCount,
                    locationIds: {
                        pickup: data.pickupLocation,
                        destination: data.destinationLocation
                    }
                };
                
                // Show booking modal instead of alert
                showBookingModal(bookingData);
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
    
    // ==============================================
    // BOOKING MODAL FUNCTIONS
    // ==============================================
    
    // Store booking data globally
    window.currentBookingData = null;
    
    // Show booking modal with booking data
    function showBookingModal(bookingData) {
        console.log('Showing booking modal with data:', bookingData);
        
        // Store booking data globally
        window.currentBookingData = bookingData;
        
        // Get modal element
        const modal = document.getElementById('bookingModal');
        
        if (!modal) {
            console.error('Booking modal not found');
            return;
        }
        
        // Populate booking summary
        const summary = document.getElementById('bookingSummary');
        if (summary) {
            summary.innerHTML = `
                <div><strong>Route:</strong> ${bookingData.pickupLocation} → ${bookingData.destinationLocation}</div>
                <div><strong>Date & Time:</strong> ${bookingData.pickupDate} at ${bookingData.pickupTime}</div>
                <div><strong>Vehicle:</strong> ${bookingData.vehicle}</div>
                <div><strong>Passengers:</strong> ${bookingData.passengers}</div>
            `;
        }
        
        // Show modal with animation
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        // Focus on first input
        setTimeout(() => {
            const firstInput = document.getElementById('fullName');
            if (firstInput) {
                firstInput.focus();
            }
        }, 100);
    }
    
    // Close booking modal
    function closeBookingModal() {
        const modal = document.getElementById('bookingModal');
        if (modal) {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            window.currentBookingData = null;
        }
    }
    
    // Submit final booking
    async function submitFinalBooking() {
        console.log('Submitting final booking...');
        
        if (!window.currentBookingData) {
            console.error('No booking data available');
            showRouteNotification('Error: Booking data not found. Please try again.', 'error');
            return;
        }
        
        // Get form data
        const form = document.getElementById('finalBookingForm');
        if (!form) {
            console.error('Final booking form not found');
            return;
        }
        
        const formData = new FormData(form);
        const bookingDetails = Object.fromEntries(formData);
        
        // Check if terms are accepted
        if (!document.getElementById('terms').checked) {
            showRouteNotification('Please accept the terms and conditions to proceed.', 'error');
            return;
        }
        
        // Combine booking data
        const completeBookingData = {
            ...window.currentBookingData,
            customerDetails: {
                fullName: bookingDetails.fullName,
                email: bookingDetails.email,
                phone: bookingDetails.phoneNumber,
                password: bookingDetails.password,
                specialRequirements: bookingDetails.specialRequirements
            }
        };
        
        console.log('Complete booking data:', completeBookingData);
        
        // Show loading state
        const submitButton = event.target;
        const originalText = submitButton.textContent;
        submitButton.disabled = true;
        submitButton.textContent = 'Submitting...';
        
        try {
            // Submit booking to backend
            const response = await fetch('/vehicle-booking/submit', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(completeBookingData)
            });
            
            const data = await response.json();
            
            if (response.ok && data.success) {
                // Success!
                showRouteNotification('Booking submitted successfully! Redirecting to payment...', 'success');
                
                // Close modal
                closeBookingModal();
                
                // Redirect to payment gateway
                if (data.payment_url) {
                    setTimeout(() => {
                        window.location.href = data.payment_url;
                    }, 1000);
                } else {
                    // Fallback: reload page
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                }
            } else {
                // Error from server
                throw new Error(data.message || 'Failed to submit booking');
            }
        } catch (error) {
            console.error('Error submitting booking:', error);
            showRouteNotification('Error: ' + error.message + '. Please try again.', 'error');
        } finally {
            // Restore button
            submitButton.disabled = false;
            submitButton.textContent = originalText;
        }
    }
    
    // Close modal when clicking outside
    document.addEventListener('click', function(event) {
        const modal = document.getElementById('bookingModal');
        if (event.target === modal) {
            closeBookingModal();
        }
    });
    
    // Close modal on escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeBookingModal();
        }
    });
    
    // Check if user exists when email is entered
    async function checkUserExists(email) {
        if (!email) {
            hideUserStatus();
            return;
        }
        
        try {
            const response = await fetch(`/api/check-user?email=${encodeURIComponent(email)}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json'
                }
            });
            
            const data = await response.json();
            
            if (data.exists) {
                showUserStatus('Existing user - enter your password to login', 'blue');
            } else {
                showUserStatus('New user - create a password', 'green');
            }
        } catch (error) {
            console.error('Error checking user:', error);
            hideUserStatus();
        }
    }
    
    // Show user status message
    function showUserStatus(message, color) {
        const statusDiv = document.getElementById('userStatus');
        const statusText = document.getElementById('userStatusText');
        
        if (statusDiv && statusText) {
            statusDiv.classList.remove('hidden');
            statusText.textContent = message;
            statusText.className = `text-sm font-medium text-${color}-600`;
        }
    }
    
    // Hide user status message
    function hideUserStatus() {
        const statusDiv = document.getElementById('userStatus');
        if (statusDiv) {
            statusDiv.classList.add('hidden');
        }
    }
    
    // Add email change listener to check user existence
    document.addEventListener('DOMContentLoaded', function() {
        const emailInput = document.getElementById('email');
        if (emailInput) {
            emailInput.addEventListener('blur', function() {
                const email = this.value.trim();
                if (email && email.includes('@')) {
                    checkUserExists(email);
                } else {
                    hideUserStatus();
                }
            });
        }
    });
    
    // ==============================================
    // END BOOKING MODAL FUNCTIONS
    // ==============================================
    
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
