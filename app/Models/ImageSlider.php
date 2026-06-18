<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageSlider extends Model
{
    protected $table = 'image_slider';

    protected $fillable = [
        'header',
        'title',
        'description',
        'image_path',
    ];
}
