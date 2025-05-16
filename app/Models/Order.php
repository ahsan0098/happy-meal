<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'reference_id',
        'email',
        'phone',
        'address',
        'delivery_time',
        'status',
        'bill',
        'comments'
    ];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'order_items', 'order_id', 'item_id');
    }
}
