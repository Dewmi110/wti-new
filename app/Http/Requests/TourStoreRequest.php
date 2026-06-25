<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TourStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:tours,slug',
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
            'highlight_activities' => 'nullable|array',
            'highlight_activities.*' => 'nullable|string',
            'group_size' => 'nullable|integer|min:1',
            'guide' => 'nullable|string|max:100',
            'price_include' => 'nullable|string|max:2000',
            'cancellation_policy' => 'nullable|string|max:2000',
            'features' => 'nullable|array',
            'features.*.label' => 'nullable|string|max:100',
            'features.*.prefix' => 'nullable|string|max:10',
            'features.*.icon' => 'nullable|string|max:100',
            'banner_img' => 'nullable|image|max:5120',
            'images' => 'nullable|array',
            'images.*' => 'image|max:5120',
            'itineraries' => 'nullable|array',
            'itineraries.*.day' => 'required_with:itineraries|integer|min:1',
            'itineraries.*.description' => 'required_with:itineraries|string',
            'visibility' => 'nullable|in:0,1',
            'currency'     => 'nullable', 'string', 'in:USD,Rs',
            'os_currency'  => 'nullable', 'string', 'in:USD,Rs',
            'os_price'     => 'nullable', 'numeric', 'min:0',
            'os_visibility'=> 'nullable', 'in:0,1',
        ];
    }
}
