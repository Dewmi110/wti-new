<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TourStoreRequest;
use App\Http\Requests\TourUpdateRequest;
use App\Models\TourCategory;
use App\Models\TourType;
use App\Models\TourTheme;
use App\Models\Country;
use App\Models\Destination;
use App\Models\Tour;
use App\Models\TourImage;
use App\Models\DayItinerary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class TourController extends Controller
{
    private const FEATURE_ICON_SOURCE_URL = 'https://raw.githubusercontent.com/FortAwesome/Font-Awesome/7.x/metadata/icons.json';

    /**
     * Normalize feature rows into a clean array for JSON storage.
     *
     * @param  array<int, array<string, mixed>>|null  $features
     * @return array<int, array{label: string, icon: string}>|null
     */
    private function formatFeatures(array|null $features): ?array
    {
        if (! is_array($features)) {
            return null;
        }

        $items = array_values(array_filter(array_map(static function (array|string|null $feature): array|null {
            if (! is_array($feature)) {
                return null;
            }

            $label = trim((string) ($feature['label'] ?? ''));
            $prefix = trim((string) ($feature['prefix'] ?? 'emoji'));
            $icon = trim((string) ($feature['icon'] ?? ''));

            if ($label === '' || $icon === '') {
                return null;
            }

            if ($prefix === '') {
                $prefix = 'emoji';
            }

            return [
                'label' => $label,
                'prefix' => $prefix,
                'icon' => $icon,
            ];
        }, $features), static function (array|null $feature): bool {
            return is_array($feature);
        }));

        return $items === [] ? null : $items;
    }

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

    public function featureIcons()
    {
        $features = Cache::remember('tour.feature-icons.catalog', now()->day(), function (): array {
            $response = Http::timeout(15)
                ->retry(2, 250)
                ->get(self::FEATURE_ICON_SOURCE_URL);

            if (! $response->successful()) {
                return [];
            }

            $catalog = $response->json();

            if (! is_array($catalog)) {
                return [];
            }

            $stylePrefixes = [
                'solid' => 'fas',
                'regular' => 'far',
                'brands' => 'fab',
            ];

            return collect($catalog)
                ->map(static function (array $metadata, string $iconName) use ($stylePrefixes): ?array {
                    $styles = array_values(array_intersect($metadata['styles'] ?? [], array_keys($stylePrefixes)));

                    if ($styles === []) {
                        return null;
                    }

                    $searchTerms = array_values(array_unique(array_filter(array_map('strval', array_merge(
                        $metadata['search']['terms'] ?? [],
                        $metadata['ligatures'] ?? [],
                        [$iconName, $metadata['label'] ?? '']
                    )))));

                    return [
                        'label' => (string) ($metadata['label'] ?? Str::headline($iconName)),
                        'prefix' => $stylePrefixes[$styles[0]],
                        'icon' => 'fa-' . $iconName,
                        'keywords' => array_map(static fn (string $term): string => Str::lower($term), $searchTerms),
                    ];
                })
                ->filter()
                ->values()
                ->all();
        });

        return response()->json($features);
    }

    public function index()
    {
        $tours = Tour::with(['category', 'type', 'theme', 'countryModel', 'images'])->paginate(10);
        return view('backend.tours.index', compact('tours'));
    }

    public function create()
    {
        $categories = TourCategory::where('status',1)->get();
        $types = TourType::where('status',1)->get();
        $themes = TourTheme::where('status',1)->get();
        $countries = Country::where('status',1)->get();
        $destinations = Destination::where('status',1)->get();

        return view('backend.tours.create', compact('categories','types','themes','countries','destinations'));
    }

    public function store(TourStoreRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug'] ?: $data['title']);
        $data['destinations'] = $data['destinations'] ?? [];
        $data['features'] = $this->formatFeatures($data['features'] ?? null) ?? [];
        $data['highlight_activities'] = $this->formatHighlightActivities($data['highlight_activities'] ?? null);
        $data['status'] = $request->has('status') ? 1 : 0;

        if ($request->hasFile('banner_img')) {
            $data['banner_img_path'] = $request->file('banner_img')->store('tours/banners', 'public');
        }

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
        $categories = TourCategory::where('status',1)->get();
        $types = TourType::where('status',1)->get();
        $themes = TourTheme::where('status',1)->get();
        $countries = Country::where('status',1)->get();
        $destinations = Destination::where('status',1)->get();

        $tour->load(['images','itineraries']);

        return view('backend.tours.edit', compact('tour','categories','types','themes','countries','destinations'));
    }

    public function update(TourUpdateRequest $request, Tour $tour)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug'] ?: $data['title']);
        $data['destinations'] = $data['destinations'] ?? [];
        $data['features'] = $this->formatFeatures($data['features'] ?? null) ?? [];
        $data['highlight_activities'] = $this->formatHighlightActivities($data['highlight_activities'] ?? null);

        // Explicitly handle status
        $data['status'] = $request->has('status') ? 1 : 0;

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

