<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = ['name', 'status'];

    public function tours()
    {
        return $this->hasMany(Tour::class, 'country');
    }

    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }
}
