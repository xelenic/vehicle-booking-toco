@extends('layouts.app')

@section('title', 'Contact Us - Ceylon Mirissa')
@section('description', 'Get in touch with Ceylon Mirissa for your Sri Lankan adventure. Contact us for tour bookings, inquiries, or to plan your perfect vacation in paradise.')

@section('content')
<!-- Hero Section -->
<section class="relative h-[50vh] flex items-center justify-center overflow-hidden pt-20">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');">
        <div class="absolute inset-0 bg-gradient-to-r from-purple-900/70 to-indigo-900/70"></div>
    </div>
    
    <div class="relative z-10 text-center text-white px-4">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl md:text-4xl font-bold playfair mb-4 animate-fade-in">
                Contact
                <span class="gradient-text">Us</span>
            </h1>
            <p class="text-sm md:text-lg mb-4 opacity-90 animate-fade-in-delay">
                Ready to start your Sri Lankan adventure? We're here to help!
            </p>
            <div class="animate-fade-in-delay-2">
                <a href="#contact-form" class="bg-gradient-to-r from-purple-600 to-indigo-500 hover:from-purple-700 hover:to-indigo-600 text-white px-6 py-3 rounded-full text-sm font-semibold transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                    Get in Touch
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Contact Information Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 playfair mb-4">
                    Get in Touch
                </h2>
                <p class="text-sm text-gray-600 max-w-3xl mx-auto">
                    Have questions about our tours? Want to customize your Sri Lankan adventure? We'd love to hear from you!
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-12">
                <!-- Phone -->
                <div class="text-center p-6 bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 mb-3">Call Us</h3>
                    <p class="text-gray-600 mb-2 text-sm">+94 77 123 4567</p>
                    <p class="text-gray-600 mb-2 text-sm">+94 11 234 5678</p>
                    <p class="text-xs text-gray-500">Mon - Fri: 8:00 AM - 6:00 PM</p>
                </div>
                
                <!-- Email -->
                <div class="text-center p-6 bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Email Us</h3>
                    <p class="text-gray-600 mb-2">info@ceylonmirissa.com</p>
                    <p class="text-gray-600 mb-2">bookings@ceylonmirissa.com</p>
                    <p class="text-sm text-gray-500">We reply within 24 hours</p>
                </div>
                
                <!-- Location -->
                <div class="text-center p-6 bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Visit Us</h3>
                    <p class="text-gray-600 mb-2">Mirissa Beach Road</p>
                    <p class="text-gray-600 mb-2">Mirissa, Southern Province</p>
                    <p class="text-sm text-gray-500">Sri Lanka</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section id="contact-form" class="py-12 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 playfair mb-4">
                    Send Us a Message
                </h2>
                <p class="text-sm text-gray-600 max-w-3xl mx-auto">
                    Fill out the form below and we'll get back to you as soon as possible to help plan your perfect Sri Lankan adventure.
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Contact Form -->
                <div class="bg-gray-50 rounded-xl p-6">
                    <form class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div>
                                <label for="firstName" class="block text-sm font-semibold text-gray-700 mb-2">First Name</label>
                                <input type="text" id="firstName" name="firstName" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 text-sm">
                            </div>
                            <div>
                                <label for="lastName" class="block text-sm font-semibold text-gray-700 mb-2">Last Name</label>
                                <input type="text" id="lastName" name="lastName" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 text-sm">
                            </div>
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                            <input type="email" id="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" id="phone" name="phone" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                        </div>
                        
                        <div>
                            <label for="tourInterest" class="block text-sm font-semibold text-gray-700 mb-2">Tour Interest</label>
                            <select id="tourInterest" name="tourInterest" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                                <option value="">Select a tour type</option>
                                <option value="cultural">Cultural Heritage Tours</option>
                                <option value="adventure">Adventure & Hiking</option>
                                <option value="wildlife">Wildlife & Safari</option>
                                <option value="beach">Beach & Relaxation</option>
                                <option value="surfing">Surfing Adventures</option>
                                <option value="custom">Custom Package</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="travelDates" class="block text-sm font-semibold text-gray-700 mb-2">Preferred Travel Dates</label>
                            <input type="text" id="travelDates" name="travelDates" placeholder="e.g., March 15-25, 2024" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                        </div>
                        
                        <div>
                            <label for="groupSize" class="block text-sm font-semibold text-gray-700 mb-2">Group Size</label>
                            <select id="groupSize" name="groupSize" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                                <option value="">Select group size</option>
                                <option value="1">Solo Traveler</option>
                                <option value="2">Couple</option>
                                <option value="3-4">Small Group (3-4)</option>
                                <option value="5-8">Medium Group (5-8)</option>
                                <option value="9+">Large Group (9+)</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">Message</label>
                            <textarea id="message" name="message" rows="5" placeholder="Tell us about your dream Sri Lankan adventure..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 resize-none"></textarea>
                        </div>
                        
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-green-600 hover:from-blue-700 hover:to-green-700 text-white py-4 rounded-lg font-semibold text-sm transition-all duration-300 transform hover:scale-105 shadow-lg">
                            Send Message
                        </button>
                    </form>
                </div>
                
                <!-- Additional Information -->
                <div class="space-y-8">
                    <!-- Quick Response -->
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Quick Response</h3>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            We typically respond to all inquiries within 24 hours. For urgent bookings or questions, please call us directly.
                        </p>
                    </div>
                    
                    <!-- Free Consultation -->
                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Free Consultation</h3>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            Not sure which tour is right for you? We offer free consultations to help you choose the perfect Sri Lankan experience.
                        </p>
                    </div>
                    
                    <!-- Flexible Booking -->
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Flexible Booking</h3>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            We understand that plans can change. Our flexible booking policies ensure you can modify your travel dates if needed.
                        </p>
                    </div>
                    
                    <!-- Social Media -->
                    <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Follow Our Journey</h3>
                        <p class="text-gray-600 mb-4">Stay updated with our latest tours and Sri Lankan adventures!</p>
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white hover:bg-blue-700 transition-colors duration-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-blue-800 rounded-full flex items-center justify-center text-white hover:bg-blue-900 transition-colors duration-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-pink-600 rounded-full flex items-center justify-center text-white hover:bg-pink-700 transition-colors duration-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 playfair mb-4">
                    Frequently Asked Questions
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Find answers to common questions about our tours and services.
                </p>
            </div>
            
            <div class="space-y-6">
                <!-- FAQ Item 1 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <button class="w-full text-left p-6 focus:outline-none focus:bg-gray-50 transition-colors duration-300" onclick="toggleFAQ(this)">
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-semibold text-gray-900">What's included in your tour packages?</h3>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </button>
                    <div class="px-6 pb-6 hidden">
                        <p class="text-gray-600 leading-relaxed">
                            All our tour packages include professional guides, transportation, entrance fees to major attractions, and accommodation (for multi-day tours). Meals are included as specified in each package description. We also provide 24/7 support throughout your journey.
                        </p>
                    </div>
                </div>
                
                <!-- FAQ Item 2 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <button class="w-full text-left p-6 focus:outline-none focus:bg-gray-50 transition-colors duration-300" onclick="toggleFAQ(this)">
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-semibold text-gray-900">Can I customize my tour package?</h3>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </button>
                    <div class="px-6 pb-6 hidden">
                        <p class="text-gray-600 leading-relaxed">
                            Absolutely! We specialize in creating custom experiences tailored to your interests, budget, and schedule. Contact us to discuss your preferences, and we'll design a personalized itinerary just for you.
                        </p>
                    </div>
                </div>
                
                <!-- FAQ Item 3 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <button class="w-full text-left p-6 focus:outline-none focus:bg-gray-50 transition-colors duration-300" onclick="toggleFAQ(this)">
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-semibold text-gray-900">What's your cancellation policy?</h3>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </button>
                    <div class="px-6 pb-6 hidden">
                        <p class="text-gray-600 leading-relaxed">
                            We offer flexible cancellation policies. Free cancellation up to 7 days before your tour date. Cancellations made 3-7 days before receive a 50% refund. Cancellations within 3 days are non-refundable but can be rescheduled.
                        </p>
                    </div>
                </div>
                
                <!-- FAQ Item 4 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <button class="w-full text-left p-6 focus:outline-none focus:bg-gray-50 transition-colors duration-300" onclick="toggleFAQ(this)">
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-semibold text-gray-900">Do you provide airport transfers?</h3>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </button>
                    <div class="px-6 pb-6 hidden">
                        <p class="text-gray-600 leading-relaxed">
                            Yes! We provide airport transfers from Colombo Bandaranaike International Airport (CMB) to your accommodation. This service is included in our multi-day packages or can be arranged separately for day tours.
                        </p>
                    </div>
                </div>
                
                <!-- FAQ Item 5 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <button class="w-full text-left p-6 focus:outline-none focus:bg-gray-50 transition-colors duration-300" onclick="toggleFAQ(this)">
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-semibold text-gray-900">What should I pack for my Sri Lankan adventure?</h3>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </button>
                    <div class="px-6 pb-6 hidden">
                        <p class="text-gray-600 leading-relaxed">
                            Pack light, breathable clothing for the tropical climate, comfortable walking shoes, sunscreen, insect repellent, and a hat. For temple visits, bring modest clothing that covers shoulders and knees. We'll provide a detailed packing list after booking.
                        </p>
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
                Ready to Start Your Adventure?
            </h2>
            <p class="text-lg mb-6 opacity-90">
                Don't wait! Contact us today and let's create the perfect Sri Lankan experience for you.
            </p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="tel:+94771234567" class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-3 rounded-full text-sm font-semibold transition-all duration-300 transform hover:scale-105">
                    Call Now: +94 77 123 4567
                </a>
                <a href="mailto:info@ceylonmirissa.com" class="border-2 border-white text-white hover:bg-white hover:text-blue-600 px-6 py-3 rounded-full text-sm font-semibold transition-all duration-300 transform hover:scale-105">
                    Email Us
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    function toggleFAQ(button) {
        const content = button.nextElementSibling;
        const icon = button.querySelector('svg');
        
        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            icon.style.transform = 'rotate(180deg)';
        } else {
            content.classList.add('hidden');
            icon.style.transform = 'rotate(0deg)';
        }
    }
    
    // Form submission handling
    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form data
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);
        
        // Show success message
        alert('Thank you for your message! We\'ll get back to you within 24 hours.');
        
        // Reset form
        this.reset();
    });
</script>
@endpush
