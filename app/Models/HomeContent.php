<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeContent extends Model
{
    use HasFactory;

    protected $table = 'home_content';

    protected $fillable = [
        'meta_key',
        'meta_value',
        'meta_description'
    ];

    public $timestamps = true;
}
