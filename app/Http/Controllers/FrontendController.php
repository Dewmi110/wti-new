<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Tour;
use App\Models\Blog;
use App\Models\Corporate;
use App\Models\ImageSlider;
use Illuminate\Http\Request;

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

    public function visit_to_srilanka(Tour $tour)
    {
        $coverImagePath = $tour->banner_img_path ?: $tour->images->first()?->img_path;
        $coverImageUrl = $coverImagePath ? \Illuminate\Support\Facades\Storage::url($coverImagePath) :
        asset('images/hero-bg-1.jpg');
        $displayPrice = $tour->discount_price ?: $tour->price;
        $locationName = optional($tour->countryModel)->country ?? 'Sri Lanka';
        $features = is_array($tour->features) ? $tour->features : [];

        $tours = Tour::query()
            ->whereHas('countryModel', static function ($query): void {
                $query->where('t_type', 1);
            })
            ->with(['countryModel', 'images'])
            ->where('status', 1)
            ->paginate(9);

        return view('frontend.inbound', compact('tours', 'coverImageUrl', 'displayPrice', 'features', 'locationName'));
    }

    public function outbound(Tour $tour)
    {
        $coverImagePath = $tour->banner_img_path ?: $tour->images->first()?->img_path;
        $coverImageUrl = $coverImagePath ? \Illuminate\Support\Facades\Storage::url($coverImagePath) :
        asset('images/hero-bg-1.jpg');
        $displayPrice = $tour->discount_price ?: $tour->price;
        $locationName = optional($tour->countryModel)->country ?? 'Sri Lanka';
        $features = is_array($tour->features) ? $tour->features : [];

         $tours = Tour::query()
            ->whereHas('countryModel', static function ($query): void {
                $query->where('t_type', 2);
            })
            ->with(['countryModel', 'images'])
            ->where('status', 1)
            ->paginate(9);
            
        return view('frontend.outbound', compact('tours', 'coverImageUrl', 'displayPrice', 'features', 'locationName'));
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

        return view('frontend.single_tour', compact('tour', 'coverImageUrl', 'displayPrice', 'features', 'locationName'));
    }

    public function blog()
    {
        $blogs = Blog::all()
            ->where('status', 1);
        return view('frontend.blog', compact('blogs'));
    }

    public function singleBlog(Blog $blog)
    {
        return view('frontend.single_blog', compact('blog'));
    }

    public function airTickets()
    {
        return view('frontend.air_tickets');
    }
    public function visaServices()
    {
        return view('frontend.visa_services');
    }

    public function miceTours()
    {
        return view('frontend.mice_tours');
    }

    public function corporate()
    {
        $corporateBanner = Corporate::latest()->first();
        return view('frontend.corporate', compact('corporateBanner'));
    }

    public function contact()
    {
        return view('frontend.contact');
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
}
