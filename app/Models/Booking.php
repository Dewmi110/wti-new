<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'tour_id', 'full_name', 'email', 'phone',
        'travelers', 'travel_date', 'special_requests', 'status',
    ];

    protected $casts = [
        'travel_date' => 'date',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
