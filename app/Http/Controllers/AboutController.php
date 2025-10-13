<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display the about page
     */
    public function index()
    {
        $about = About::active()
            ->with('heroMedia')
            ->ordered()
            ->first();

        if (!$about) {
            // Return default content if no about page exists
            $about = (object) [
                'title' => 'About Ceylon Mirissa Tours',
                'subtitle' => 'Discover the Beauty of Sri Lanka with Us',
                'content' => 'Welcome to Ceylon Mirissa Tours, your gateway to experiencing the incredible beauty and rich culture of Sri Lanka. We are passionate about providing unforgettable travel experiences that showcase the best of this beautiful island nation.',
                'hero_image_url' => asset('slider/default-about.jpg'),
                'features' => [
                    ['title' => 'Expert Guides', 'description' => 'Our experienced local guides know every hidden gem'],
                    ['title' => 'Premium Service', 'description' => 'We provide top-quality service and attention to detail'],
                    ['title' => 'Sustainable Tourism', 'description' => 'We promote responsible and sustainable tourism practices']
                ],
                'statistics' => [
                    ['number' => '500+', 'label' => 'Happy Customers'],
                    ['number' => '50+', 'label' => 'Tour Packages'],
                    ['number' => '5', 'label' => 'Years Experience'],
                    ['number' => '98%', 'label' => 'Customer Satisfaction']
                ],
                'team_members' => [
                    ['name' => 'Our Team', 'position' => 'Professional Guides', 'description' => 'Meet our passionate team of local experts']
                ]
            ];
        }

        return view('about', compact('about'));
    }
}
