<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersItem extends Model
{
    protected $table = 'orders_items';

    protected $fillable = [
        'name',
        'price',
        'amount',

        'order_id',
    ];

}
