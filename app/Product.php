<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function productTypes(){
        return $this->belongsTo(ProductType::class);
    }
}
