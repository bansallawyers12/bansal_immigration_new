<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostcodeRange extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_postcode',
        'end_postcode',
        'category',
    ];
}


