<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'delivery',
        'comment',
        'status',
        'amount',
        'address'
    ];

    public function cart()
    {
        return $this->hasMany(Order_cart::class, 'order_id');
    }
}
