<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function productTypes(){
        return $this->belongsTo(ProductType::class);
    }

    protected $fillable = [
        'product_type_id', 'name', 'image', 'desc', 'price', 'stock',
    ];
}
