<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourTheme extends Model
{
    protected $table = 'tour_themes';

    protected $fillable = ['theme_name', 'status'];

    public function tours()
    {
        return $this->hasMany(Tour::class, 't_theme');
    }
}
