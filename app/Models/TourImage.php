<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourImage extends Model
{
    protected $table = 'tour_images';

    protected $fillable = ['t_id', 'img_path', 'status'];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 't_id');
    }
}
