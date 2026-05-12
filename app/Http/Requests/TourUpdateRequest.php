<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TourUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $tourId = $this->route('tour') ? $this->route('tour')->id : null;

        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:tours,slug,' . $tourId,
            't_category' => 'required|exists:tour_categories,id',
            't_type' => 'required|exists:tour_types,id',
            't_theme' => 'required|exists:tour_themes,id',
            'description' => 'required|string',
            'duration' => 'required|string|max:100',
            'country' => 'required|exists:countries,id',
            'destinations' => 'nullable|array',
            'destinations.*' => 'integer|exists:destinations,id',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'highlight_activities' => 'nullable|string',
            'banner_img' => 'nullable|image|max:5120',
            'images' => 'nullable|array',
            'images.*' => 'image|max:5120',
            'itineraries' => 'nullable|array',
            'itineraries.*.day' => 'required_with:itineraries|integer|min:1',
            'itineraries.*.description' => 'required_with:itineraries|string',
            'visibility' => 'nullable|in:0,1',
        ];
    }
}
