<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_cart extends Model
{
    protected $table = 'order_cart';

    protected $fillable = [
        'order_id',
        'cymbals_id',
        'quantity',
        'created_at'
    ];

    public function set()
    {
        return $this->belongsTo(Cymbals::class,'cymbals_id');
    }
}
