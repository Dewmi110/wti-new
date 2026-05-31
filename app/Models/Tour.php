<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class Tour extends Model
{
    protected $table = 'tours';

    protected $fillable = [
        't_category', 't_type', 't_theme', 'title', 'slug', 'description', 'duration', 'country', 'destinations', 'price', 'discount_price', 'highlight_activities', 'features', 'banner_img_path', 'visibility', 'status',
    ];

    protected $casts = [
        'destinations' => 'array',
        'features' => 'array',
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(TourCategory::class, 't_category');
    }

    public function type()
    {
        return $this->belongsTo(TourType::class, 't_type');
    }

    public function theme()
    {
        return $this->belongsTo(TourTheme::class, 't_theme');
    }

    public function countryModel()
    {
        return $this->belongsTo(Country::class, 'country');
    }

    public function images()
    {
        return $this->hasMany(TourImage::class, 't_id');
    }

    public function itineraries()
    {
        return $this->hasMany(DayItinerary::class, 't_id');
    }

    // Helper to get related Destination models when destinations stored as IDs
    public function destinationModels()
    {
        if (empty($this->destinations) || !is_array($this->destinations)) {
            return collect();
        }

        return Destination::whereIn('id', $this->destinations)->get();
    }
}
