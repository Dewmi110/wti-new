<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Tour;
use App\Models\TourType;
use App\Models\Country;
use App\Models\ServiceType;
use App\Models\Service;
use App\Models\ContactBanner;
use App\Models\Blog;
use App\Models\Corporate;
use App\Models\BlogBanner;
use App\Models\ImageSlider;
use App\Models\BlogSlider;
use App\Models\Booking;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FrontendController extends Controller
{
    public function index()
    {
        $destinations = Destination::query()
            ->with(['country'])
            ->where('status', 1)
            ->latest()
            ->take(8)
            ->get();

        $tours = Tour::with(['category', 'type', 'theme', 'countryModel', 'images'])
            ->latest()
            ->where('status', 1)
            ->where('visibility', 1)
            ->take(4)
            ->get();

        $featured_tours = Tour::with(['category', 'type', 'theme', 'countryModel', 'images'])
            ->latest()
            ->where('status', 1)
            ->where('visibility', 0)
            ->take(4)
            ->get();

        $blogs = Blog::latest()
            ->where('status', 1)
            ->take(3)
            ->get();

        

        $imageSliders = ImageSlider::all();

        return view('frontend.index', compact('destinations', 'tours', 'featured_tours', 'blogs', 'imageSliders'));
    }

    public function visit_to_srilanka()
    {
        $tourType = TourType::find(1);
        
        $coverImageUrl = $tourType && $tourType->banner_image
            ? \Illuminate\Support\Facades\Storage::url($tourType->banner_image)
            : asset('images/hero-bg-1.jpg');

        $type_name = $tourType->type_name ?? 'Tour List';
    
        $tours = Tour::query()
            ->whereHas('countryModel', static function ($query): void {
                $query->where('t_type', 1);
            })
            ->with(['countryModel', 'images'])
            ->where('status', 1)
            ->paginate(9);
    
        return view('frontend.inbound', compact('tours', 'coverImageUrl', 'type_name')); 
    }

    public function outbound()
    {
        $tourType = TourType::find(2);
    
    $coverImageUrl = $tourType && $tourType->banner_image
        ? \Illuminate\Support\Facades\Storage::url($tourType->banner_image)
        : asset('images/hero-bg-1.jpg');
    
    $type_name = $tourType->type_name ?? 'Tour List';

    $tours = Tour::query()
        ->whereHas('countryModel', static function ($query): void {
            $query->where('t_type', 2);
        })
        ->with(['countryModel', 'images'])
        ->where('status', 1)
        ->paginate(9);

    return view('frontend.outbound', compact('tours', 'coverImageUrl', 'type_name'));
    }

    public function singleTour(Tour $tour)
    {
        $tour->load(['images', 'itineraries']);

        $coverImagePath = $tour->banner_img_path ?: $tour->images->first()?->img_path;
        $coverImageUrl = $coverImagePath ? \Illuminate\Support\Facades\Storage::url($coverImagePath) :
        asset('images/hero-bg-1.jpg');
        $displayPrice = $tour->discount_price ?: $tour->price;
        $locationName = optional($tour->countryModel)->name ?? 'Sri Lanka';
        $features = is_array($tour->features) ? $tour->features : [];
        $destinations  = Country::where('status', 1)->orderBy('name')->get();

        return view('frontend.single_tour', compact('tour', 'coverImageUrl', 'displayPrice', 'features', 'locationName', 'destinations'));
    }

    public function blog()
    {
        $blogs = Blog::all()->where('status', 1);
        $sliders = BlogSlider::all();
        $blogBanner = BlogBanner::latest()->first();
        return view('frontend.blog', compact('blogs', 'sliders', 'blogBanner'));
    }

    public function singleBlog(Blog $blog)
{
    $coverImageUrl = $blog->image 
        ? asset('storage/' . $blog->image) 
        : asset('images/hero-bg-1.jpg');

    return view('frontend.single_blog', compact('blog', 'coverImageUrl'));
}

    public function airTickets()
    {
        $airTicketsBanner = Service::where('s_id', 1)->latest()->first();
        $airTickets = Service::where('s_id', 1)->latest()->first();
        
        return view('frontend.air_tickets', compact('airTicketsBanner', 'airTickets'));
    }

    public function visaServices()
    {
        $visaServicesBanner = Service::where('s_id', 2)->latest()->first();
        $visaServices = Service::where('s_id', 2)->latest()->first();
        
        return view('frontend.visa_services', compact('visaServicesBanner', 'visaServices'));
    }

    public function miceTours()
    {
        $miceToursBanner = Service::where('s_id', 5)->latest()->first();
        $miceTours = Service::where('s_id', 5)->latest()->first();
        
        return view('frontend.mice_tours', compact('miceToursBanner', 'miceTours'));
    }

    public function corporate()
    {
        $corporateBanner = Corporate::latest()->first();
        return view('frontend.corporate', compact('corporateBanner'));
    }

    public function contact()
    {
        $contactBanner = ContactBanner::latest()->first();
        $destinations  = \App\Models\Country::where('status', 1)->orderBy('name')->get();
        $serviceTypes  = \App\Models\ServiceType::where('status', 1)->orderBy('name')->get();
        return view('frontend.contact', compact('destinations', 'serviceTypes', 'contactBanner') );
    }

     public function sendInquiry(Request $request)
    {
        $validated = $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'travelers' => 'required|integer|min:1',
            'start_date' => 'nullable|date',
            'budget' => 'nullable|string',
            'message' => 'nullable|string'
        ]);

        // TODO: Save inquiry to database or send email
        // Example: TourInquiry::create($validated);
        // Example: Mail::send(...);

        return redirect()->back()->with('success', 'Thank you! We will contact you shortly.');
    }

    /**
     * Book a tour
     */
    public function bookTour(Request $request)
    {
        $validated = $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'travelers' => 'required|integer|min:1',
            'travel_date' => 'nullable|date',
            'special_requests' => 'nullable|string'
        ]);

        // TODO: Create booking record and process payment
        // Example: $booking = Booking::create($validated);

        return redirect()->back()->with('success', 'Booking request submitted! Please check your email for confirmation.');
    }

    public function storeBooking(Request $request)
{
    $request->validate([
        'tour_id'          => 'required|exists:tours,id',
        'full_name'        => 'required|string|max:255',
        'email'            => 'required|email|max:255',
        'phone'            => 'required|string|max:30',
        'travelers'        => 'required|integer|min:1',
        'travel_date'      => 'nullable|date|after_or_equal:today',
        'special_requests' => 'nullable|string|max:1000',
    ]);

    Booking::create($request->only([
        'tour_id', 'full_name', 'email', 'phone',
        'travelers', 'travel_date', 'special_requests',
    ]));

    return redirect()->back()->with('booking_success', true);
}
}
