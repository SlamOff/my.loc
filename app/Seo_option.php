<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seo_option extends Model
{
    protected $fillable = [
        'title',
        'description',
        'keywords',
    ];
}
