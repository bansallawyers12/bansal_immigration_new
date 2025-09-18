<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeContent;  // Stub model
use App\Models\Slider;       // Stub
use App\Models\Blog;         // Stub
use App\Models\Service;      // Stub

class HomeController extends Controller
{
    public function index()
    {
        $seoTitle = HomeContent::where('meta_key', 'meta_title')->first()?->meta_value ?? 'Bansal Immigration';
        $seoDesc = HomeContent::where('meta_key', 'meta_description')->first()?->meta_value ?? 'Your Future, Our Priority';
        $sliderstat = HomeContent::where('meta_key', 'sliderstatus')->first()?->meta_value ?? 1;
        $meetLink = HomeContent::where('meta_key', 'meet_link')->first()?->meta_value ?? '/contact';
        $sliderLists = Slider::active()->ordered()->get();
        $blogLists = Blog::active()->latest()->take(3)->get();
        $serviceLists = Service::active()->orderBy('order')->get();

        return view('index', compact('seoTitle', 'seoDesc', 'sliderstat', 'meetLink', 'sliderLists', 'blogLists', 'serviceLists'));
    }

    // Stub other methods (about, services, etc.) – return view('about'); for now
    public function about() { return view('about'); }
    public function services() { 
        $serviceLists = Service::active()->orderBy('order')->get();
        return view('ourservices', compact('serviceLists')); 
    }
    public function serviceDetail($slug) { 
        $servicesdetailists = Service::active()->where('slug', $slug)->firstOrFail();
        return view('servicesdetail', compact('servicesdetailists')); 
    }
    public function blogs() { 
        $bloglists = Blog::active()->latest()->paginate(12);
        return view('blogs', compact('bloglists')); 
    }
    public function blogDetail($slug) { 
        $blogdetailists = Blog::active()->where('slug', $slug)->firstOrFail();
        return view('blogdetail', compact('blogdetailists')); 
    }
    public function appointment() { return view('bookappointment'); }
    public function storeAppointment(Request $request) { /* Handle form */ return response()->json(['success' => true, 'message' => 'Appointment booked!']); }
    public function contact() { return view('contact'); }
    
    // Utility Pages
    public function testimonials() { return view('pages.testimonials'); }
    public function team() { return view('pages.team'); }
    public function whyChoose() { return view('pages.why-choose'); }
    public function missionVision() { return view('pages.mission-vision'); }
    
    // Legal Pages
    public function privacyPolicy() { return view('legal.privacy-policy'); }
    public function termsConditions() { return view('legal.terms-conditions'); }
    public function disclaimer() { return view('legal.disclaimer'); }
    public function cookiePolicy() { return view('legal.cookie-policy'); }
}