<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['s_id', 'title', 'description','banner_image'];

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class, 's_id');
    }
}
