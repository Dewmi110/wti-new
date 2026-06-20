<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Corporate extends Model
{
    protected $table = 'corporates';

    protected $fillable = [
        'title',
        'sub_title',
        'description',
        'banner_image',
    ];
}
