<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Country;
use App\Models\Destination;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Stats cards
        $totalBookings = Booking::count();
        $activeUsers = User::count();
        $totalDestinations = Destination::count();
        $totalCountries = Country::count();

        // Hotels / featured tours section (using Tour as the "hotels" data source)
        $featuredTours = Tour::latest()->take(3)->get();

        // Booking history (latest bookings)
        $recentBookings = Booking::with('tour')
            ->latest()
            ->take(4)
            ->get();

        // Best resorts (could be top-rated tours, or a separate Resort model if you have one)
        // $bestResorts = Tour::orderByDesc('rating') // adjust if you don't have a rating column
        //     ->take(3)
        //     ->get();

        return view('backend.dashboardV2', [
            'totalBookings'      => $totalBookings,
            // 'totalRevenue'       => $totalRevenue,
            'activeUsers'        => $activeUsers,
            'totalDestinations'  => $totalDestinations,
            'totalCountries'     => $totalCountries,
            'featuredTours'      => $featuredTours,
            'recentBookings'     => $recentBookings,
            // 'bestResorts'        => $bestResorts,
        ]);
    }
}
