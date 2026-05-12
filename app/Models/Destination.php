<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $table = 'destinations';

    protected $fillable = ['name', 'status', 'country_id'];

    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'destination_tour', 'destination_id', 'tour_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
