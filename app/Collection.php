<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable = [
        'name',
        'alias',
        'position',
        'type',
    ];
    
    public function cymbals()
    {
        return $this->hasMany(Cymbals::class, 'collection_id');
    }
}
