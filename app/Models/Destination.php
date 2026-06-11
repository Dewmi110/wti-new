<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $table = 'destinations';

    protected $fillable = ['name', 'status', 'country_id', 'image'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
