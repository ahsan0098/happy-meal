<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'menu_id',
        'price',
        'description',
        'image',
        'is_available',
        'is_featured',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
