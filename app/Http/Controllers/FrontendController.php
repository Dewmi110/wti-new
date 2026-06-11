<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Destination;
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

        return view('frontend.index', compact('destinations'));
    }
        // public function about()
        // {
        //     return view('frontend.about');
        // }
    
        public function visit_to_srilanka()
        {
            $tours = Tour::query()
                ->whereHas('countryModel', static function ($query): void {
                    $query->where('name', 'Sri Lanka');
                })
                ->with(['countryModel', 'images'])
                ->latest()
                ->paginate(9);

            return view('frontend.inbound', compact('tours'));
        }
    
        public function outbound()
        {
            return view('frontend.outbound');
        }

        public function singleTour(Tour $tour)
        {
            return view('frontend.single_tour', compact('tour'));
        }
    
        public function blog()
        {
            return view('frontend.blog');
        }
    
        public function contact()
        {
            return view('frontend.contact');
        }
}
