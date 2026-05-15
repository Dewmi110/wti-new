<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TourStoreRequest;
use App\Http\Requests\TourUpdateRequest;
use App\Models\Tour;
use App\Models\TourImage;
use App\Models\DayItinerary;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TourController extends Controller
{
    private function formatHighlightActivities(array|string|null $highlightActivities): ?string
    {
        if (! is_array($highlightActivities)) {
            return null;
        }

        $activities = array_values(array_filter(array_map(static function ($activity) {
            return trim((string) $activity);
        }, $highlightActivities), static function ($activity) {
            return $activity !== '';
        }));

        return $activities === [] ? null : implode("\n", $activities);
    }

    public function index()
    {
        $tours = Tour::with(['category', 'type', 'theme', 'countryModel', 'images'])->paginate(20);
        return view('backend.tours.index', compact('tours'));
    }

    public function create()
    {
        $categories = \App\Models\TourCategory::where('status',1)->get();
        $types = \App\Models\TourType::where('status',1)->get();
        $themes = \App\Models\TourTheme::where('status',1)->get();
        $countries = \App\Models\Country::where('status',1)->get();
        $destinations = \App\Models\Destination::where('status',1)->get();

        return view('backend.tours.create', compact('categories','types','themes','countries','destinations'));
    }

    public function store(TourStoreRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug'] ?: $data['title']);
        $data['destinations'] = $data['destinations'] ?? [];
        $data['highlight_activities'] = $this->formatHighlightActivities($data['highlight_activities'] ?? null);
        if ($request->hasFile('banner_img')) {
            $data['banner_img_path'] = $request->file('banner_img')->store('tours/banners', 'public');
        }

        $data['status'] = 0; // default inactive

        $tour = Tour::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('tours/images', 'public');
                TourImage::create(['t_id' => $tour->id, 'img_path' => $path]);
            }
        }

        if (!empty($data['itineraries']) && is_array($data['itineraries'])) {
            foreach ($data['itineraries'] as $it) {
                DayItinerary::create(['t_id' => $tour->id, 'day' => $it['day'], 'description' => $it['description']]);
            }
        }

        return redirect()->route('admin.tours.index')->with('success', 'Tour created');
    }

    public function edit(Tour $tour)
    {
        $categories = \App\Models\TourCategory::where('status',1)->get();
        $types = \App\Models\TourType::where('status',1)->get();
        $themes = \App\Models\TourTheme::where('status',1)->get();
        $countries = \App\Models\Country::where('status',1)->get();
        $destinations = \App\Models\Destination::where('status',1)->get();

        $tour->load(['images','itineraries']);

        return view('backend.tours.edit', compact('tour','categories','types','themes','countries','destinations'));
    }

    public function update(TourUpdateRequest $request, Tour $tour)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug'] ?: $data['title']);
        $data['destinations'] = $data['destinations'] ?? [];
        $data['highlight_activities'] = $this->formatHighlightActivities($data['highlight_activities'] ?? null);

        if ($request->hasFile('banner_img')) {
            $data['banner_img_path'] = $request->file('banner_img')->store('tours/banners', 'public');
        }

        $tour->update($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('tours/images', 'public');
                TourImage::create(['t_id' => $tour->id, 'img_path' => $path]);
            }
        }

        // replace itineraries
        $tour->itineraries()->delete();
        if (!empty($data['itineraries']) && is_array($data['itineraries'])) {
            foreach ($data['itineraries'] as $it) {
                DayItinerary::create(['t_id' => $tour->id, 'day' => $it['day'], 'description' => $it['description']]);
            }
        }

        return redirect()->route('admin.tours.index')->with('success', 'Tour updated');
    }

    public function destroy(Tour $tour)
    {
        $tour->update(['status' => 2]);
        return redirect()->route('admin.tours.index')->with('success', 'Tour deleted');
    }
}

