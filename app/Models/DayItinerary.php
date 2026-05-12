<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DayItinerary extends Model
{
    protected $table = 'day_itinerary';

    protected $fillable = ['t_id', 'day', 'description', 'status'];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 't_id');
    }
}
