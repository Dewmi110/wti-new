<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class GooglePlacesService
{
    protected $apiKey;
    protected $placeId;

    public function __construct()
    {
        $this->apiKey = env('GOOGLE_MAPS_API_KEY');
        $this->placeId = env('GOOGLE_PLACE_ID');
    }

    /**
     * Get place reviews (cached)
     * Returns array with keys: name, rating, text, time, url
     */
    public function getReviews(int $limit = 5): array
    {
        if (! $this->apiKey || ! $this->placeId) {
            return [];
        }

        return Cache::remember("google_place_reviews_{$this->placeId}", now()->addHours(12), function () use ($limit) {
            $url = 'https://maps.googleapis.com/maps/api/place/details/json';
            $resp = Http::get($url, [
                'place_id' => $this->placeId,
                'fields'   => 'name,rating,reviews,url',
                'key'      => $this->apiKey,
            ]);

            if (! $resp->ok()) {
                return [];
            }

            $body = $resp->json();
            $result = $body['result'] ?? null;
            if (! $result || empty($result['reviews'])) {
                return [];
            }

            $reviews = array_slice($result['reviews'], 0, $limit);
            return array_map(function ($r) use ($result) {
                return [
                    'author_name' => $r['author_name'] ?? 'Guest',
                    'rating'      => $r['rating'] ?? null,
                    'text'        => $r['text'] ?? '',
                    'time'        => $r['relative_time_description'] ?? null,
                    'profile_photo_url' => $r['profile_photo_url'] ?? null,
                    'url'         => $result['url'] ?? null,
                ];
            }, $reviews);
        });
    }
}
