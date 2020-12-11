<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function productTypes(){
        return $this->belongsTo(ProductType::class);
    }

    public function users(){
        return $this->belongsToMany(User::class)->withPivot('quantity');
    }

    public function transactions(){
        return $this->belongsToMany(Transaction::class)->withPivot('quantity');
    }

    protected $fillable = [
        'product_type_id', 'name', 'image', 'desc', 'price', 'stock',
    ];
}
