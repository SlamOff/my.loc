<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cymbal_locale extends Model
{
    protected $table = 'cymbals_locales';

    protected $fillable = [
        'cymbal_id',
        'language',
        'description',
    ];
}
