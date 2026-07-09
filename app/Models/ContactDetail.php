<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactDetail extends Model
{
    protected $fillable = [
        'location',
        'phone',
        'whatsapp_number',
        'email',
    ];
}
