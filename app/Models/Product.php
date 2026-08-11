<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'Product';
    protected $guarded = [];
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
