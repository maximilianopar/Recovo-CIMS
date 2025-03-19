<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'stock'];

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_items')->withPivot('quantity')->withTimestamps();
    }
}
