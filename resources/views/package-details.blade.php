@extends('layouts.app')

@section('title', $package->title . ' - Ceylon Mirissa')
@section('description', Str::limit($package->description, 160))

@section('content')
<!-- Hero Section with Image Slider -->
<section class="relative h-screen overflow-hidden">
    <div class="swiper package-swiper h-full">
        <div class="swiper-wrapper">
            <!-- Main Package Image -->
            <div class="swiper-slide relative">
                <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ $package->image_url }}')"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-black/50 to-black/30"></div>
            </div>
            
            <!-- Additional Images from Package -->
            @if($package->images && count($package->images) > 0)
                @foreach($package->images as $image)
                <div class="swiper-slide relative">
                    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('storage/' . $image) }}')"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-black/50 to-black/30"></div>
                </div>
                @endforeach
            @endif
            
            <!-- Sample Travel Images -->
            @if($package->category->slug === 'cultural')
                <div class="swiper-slide relative">
                    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('slider/sigiriya_rock.jpg') }}')"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-black/50 to-black/30"></div>
                </div>
                <div class="swiper-slide relative">
                    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('slider/thooth_relic.jpg') }}')"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-black/50 to-black/30"></div>
                </div>
            @elseif($package->category->slug === 'wildlife')
                <div class="swiper-slide relative">
                    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('slider/whale_watiching.jpg') }}')"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-black/50 to-black/30"></div>
                </div>
                <div class="swiper-slide relative">
                    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('slider/yala_safari.jpg') }}')"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-black/50 to-black/30"></div>
                </div>
            @elseif($package->category->slug === 'adventure')
                <div class="swiper-slide relative">
                    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('slider/ella_city_tour.jpg') }}')"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-black/50 to-black/30"></div>
                </div>
                <div class="swiper-slide relative">
                    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('slider/arugam_bay.jpg') }}')"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-black/50 to-black/30"></div>
                </div>
            @endif
        </div>
        
        <!-- Navigation Buttons -->
        <div class="swiper-button-next package-swiper-next"></div>
        <div class="swiper-button-prev package-swiper-prev"></div>
        
        <!-- Pagination -->
        <div class="swiper-pagination package-swiper-pagination"></div>
    </div>
    
    <!-- Package Info Overlay -->
    <div class="absolute bottom-0 left-0 right-0 z-10 p-8">
        <div class="max-w-6xl mx-auto">
            <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-6 shadow-2xl">
                <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                    <div class="flex-1">
                        <div class="flex items-center gap-4 mb-4">
                            <span class="text-white px-4 py-2 rounded-full text-sm font-semibold" style="background-color: {{ $package->category->color }}">
                                {{ $package->category->name }}
                            </span>
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 text-yellow-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <span class="font-semibold">{{ $package->rating }}</span>
                                <span class="text-sm ml-1">({{ $package->reviews_count }} reviews)</span>
                            </div>
                        </div>
                        <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 playfair mb-4">
                            {{ $package->title }}
                        </h1>
                        <p class="text-lg text-gray-600 mb-4">
                            {{ $package->description }}
                        </p>
                        <div class="flex items-center gap-6 text-gray-600">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $package->duration }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                {{ $package->difficulty }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                {{ $package->group_size }}
                            </div>
                        </div>
                    </div>
                    <div class="text-center lg:text-right">
                        <div class="text-4xl font-bold mb-2" style="color: {{ $package->category->color }}">
                            {{ $package->formatted_price }}
                        </div>
                        @if($package->original_price)
                        <div class="text-lg text-gray-500 line-through mb-4">
                            {{ $package->formatted_original_price }}
                        </div>
                        @endif
                        <button onclick="openBookingModal()" class="bg-gradient-to-r from-blue-600 to-green-600 hover:from-blue-700 hover:to-green-700 text-white px-8 py-4 rounded-full text-lg font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                            Book This Package
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Package Details Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Highlights -->
                    <div class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 playfair mb-6">What's Included</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($package->highlights ?? [] as $highlight)
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700 font-medium">{{ $highlight }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Detailed Description -->
                    <div class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 playfair mb-6">About This Experience</h2>
                        <div class="prose prose-lg max-w-none">
                            <p class="text-gray-600 leading-relaxed mb-6">
                                {{ $package->description }}
                            </p>
                            @if($package->short_description)
                            <p class="text-gray-600 leading-relaxed">
                                {{ $package->short_description }}
                            </p>
                            @endif
                        </div>
                    </div>

                    <!-- Itinerary -->
                    @if($package->itinerary)
                    <div class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 playfair mb-6">Itinerary</h2>
                        <div class="prose prose-lg max-w-none">
                            <p class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $package->itinerary }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Requirements -->
                    @if($package->requirements)
                    <div class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 playfair mb-6">Requirements</h2>
                        <div class="prose prose-lg max-w-none">
                            <p class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $package->requirements }}</p>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Booking Card -->
                    <div class="bg-gray-50 rounded-2xl p-6 sticky top-8 mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 playfair mb-4">Book This Package</h3>
                        <div class="text-center mb-6">
                            <div class="text-4xl font-bold mb-2" style="color: {{ $package->category->color }}">
                                {{ $package->formatted_price }}
                            </div>
                            @if($package->original_price)
                            <div class="text-lg text-gray-500 line-through mb-2">
                                {{ $package->formatted_original_price }}
                            </div>
                            @endif
                            <div class="text-sm text-gray-600">per person</div>
                        </div>
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Duration:</span>
                                <span class="font-semibold">{{ $package->duration }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Difficulty:</span>
                                <span class="font-semibold">{{ $package->difficulty }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Group Size:</span>
                                <span class="font-semibold">{{ $package->group_size }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Category:</span>
                                <span class="font-semibold">{{ $package->category->name }}</span>
                            </div>
                        </div>
                        
                        <button onclick="openBookingModal()" class="w-full bg-gradient-to-r from-blue-600 to-green-600 hover:from-blue-700 hover:to-green-700 text-white py-4 px-6 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                            Book Now
                        </button>
                        
                        <div class="text-center mt-4">
                            <p class="text-sm text-gray-500">Free cancellation up to 24 hours before</p>
                        </div>
                    </div>

                    <!-- What's Included/Not Included -->
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 mb-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">What's Included</h3>
                        @if($package->included)
                        <div class="prose prose-sm max-w-none">
                            <p class="text-gray-600 whitespace-pre-line">{{ $package->included }}</p>
                        </div>
                        @else
                        <p class="text-gray-500 text-sm">Please contact us for details</p>
                        @endif
                    </div>

                    @if($package->not_included)
                    <div class="bg-white border border-gray-200 rounded-2xl p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Not Included</h3>
                        <div class="prose prose-sm max-w-none">
                            <p class="text-gray-600 whitespace-pre-line">{{ $package->not_included }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Packages -->
@if($relatedPackages->count() > 0)
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 playfair mb-4">Related Packages</h2>
                <p class="text-xl text-gray-600">Discover more amazing experiences</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($relatedPackages as $relatedPackage)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="relative h-48">
                        <img src="{{ $relatedPackage->image_url }}" alt="{{ $relatedPackage->title }}" class="w-full h-full object-cover">
                        <div class="absolute top-4 left-4 text-white px-3 py-1 rounded-full text-sm font-semibold" style="background-color: {{ $relatedPackage->category->color }}">
                            {{ $relatedPackage->category->name }}
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 playfair mb-2">{{ $relatedPackage->title }}</h3>
                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($relatedPackage->description, 100) }}</p>
                        <div class="flex items-center justify-between">
                            <div class="text-2xl font-bold" style="color: {{ $relatedPackage->category->color }}">
                                {{ $relatedPackage->formatted_price }}
                            </div>
                            <a href="{{ route('package.details', $relatedPackage->slug) }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors duration-300">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

<!-- Booking Modal -->
<div id="bookingModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-[10000] hidden p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto relative">
        <button onclick="closeBookingModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 transition-colors duration-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
        <div class="p-6">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900 playfair mb-2">Book {{ $package->title }}</h2>
                @if(auth()->check())
                    <p class="text-gray-600">Complete your booking details below</p>
                    <div class="mt-2 flex items-center justify-center text-xs text-green-600 bg-green-50 px-3 py-1 rounded-full">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Your details have been auto-filled
                    </div>
                @else
                    <p class="text-gray-600">Complete your booking details and create your account</p>
                    <div class="mt-2 flex items-center justify-center text-xs text-blue-600 bg-blue-50 px-3 py-1 rounded-full">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        We'll create an account for you automatically
                    </div>
                @endif
            </div>
            
            <form class="space-y-4" method="POST" action="{{ route('bookings.store') }}">
                @csrf
                <input type="hidden" name="package_id" value="{{ $package->id }}">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Full Name</label>
                    <input type="text" name="full_name" id="full_name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm" placeholder="Enter your full name" value="{{ auth()->check() ? auth()->user()->name : '' }}">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Email</label>
                    <input type="email" name="email" id="email" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm" placeholder="Enter your email" value="{{ auth()->check() ? auth()->user()->email : '' }}">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Phone Number</label>
                    <input type="tel" name="phone" id="phone" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm" placeholder="Enter your phone number">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Travel Date</label>
                    <input type="date" name="travel_date" id="travel_date" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Number of Travelers</label>
                    <select name="travelers" id="travelers" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        <option value="1">1 Person</option>
                        <option value="2">2 People</option>
                        <option value="3">3 People</option>
                        <option value="4">4 People</option>
                        <option value="5">5+ People</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Special Requirements</label>
                    <textarea name="special_requirements" id="special_requirements" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm" rows="2" placeholder="Any special requirements or notes"></textarea>
                </div>
            </div>
            
            @if(!auth()->check())
            <!-- Guest Account Creation Fields -->
            <div class="border-t border-gray-200 pt-4 mt-6">
                <div class="flex items-center mb-4">
                    <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900">Create Your Account</h3>
                </div>
                <p class="text-sm text-gray-600 mb-4">We'll create an account for you so you can manage your bookings and get updates.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Password</label>
                        <input type="password" name="password" id="password" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm" placeholder="Create a password (min 8 characters)" required>
                        <p class="text-xs text-gray-500 mt-1">Minimum 8 characters</p>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm" placeholder="Confirm your password" required>
                    </div>
                </div>
            </div>
            @endif
            
            <div class="bg-gray-50 rounded-lg p-3">
                <h3 class="text-base font-semibold text-gray-900 mb-2">Booking Summary</h3>
                <div class="space-y-1.5">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">{{ $package->title }}</span>
                        <span class="font-semibold">{{ $package->formatted_price }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Duration</span>
                        <span class="font-semibold">{{ $package->duration }}</span>
                    </div>
                    <div class="border-t border-gray-200 pt-1.5">
                        <div class="flex justify-between text-base font-bold">
                            <span>Total</span>
                            <span style="color: {{ $package->category->color }}">{{ $package->formatted_price }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex gap-2 pt-1">
                <button type="button" onclick="closeBookingModal()" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-3 rounded-lg font-medium transition-colors duration-300 text-sm">
                    Cancel
                </button>
                <button type="submit" class="flex-1 bg-gradient-to-r from-blue-600 to-green-600 hover:from-blue-700 hover:to-green-700 text-white py-2 px-3 rounded-lg font-medium transition-all duration-300 transform hover:scale-105 text-sm">
                    @if(auth()->check())
                        Book & Pay Now
                    @else
                        Create Account & Pay
                    @endif
                </button>
            </div>
        </form>
        </div>
    </div>
</div>

<script>
// Initialize Swiper for package images
document.addEventListener('DOMContentLoaded', function() {
    const packageSwiper = new Swiper('.package-swiper', {
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.package-swiper-next',
            prevEl: '.package-swiper-prev',
        },
        pagination: {
            el: '.package-swiper-pagination',
            clickable: true,
        },
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        }
    });
});

// Booking Modal Functions
function openBookingModal() {
    document.getElementById('bookingModal').classList.remove('hidden');
}

function closeBookingModal() {
    document.getElementById('bookingModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('bookingModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeBookingModal();
    }
});
</script>
@endsection
