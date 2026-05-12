<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourCategory extends Model
{
    protected $table = 'tour_categories';

    protected $fillable = ['category_name', 'status'];

    public function tours()
    {
        return $this->hasMany(Tour::class, 't_category');
    }
}
