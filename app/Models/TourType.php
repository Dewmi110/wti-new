<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourType extends Model
{
    protected $table = 'tour_types';

    protected $fillable = ['type_name', 'status'];

    public function tours()
    {
        return $this->hasMany(Tour::class, 't_type');
    }
}
