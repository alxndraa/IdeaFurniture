<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    public function products(){
        return $this->hasMany(Product::class);
    }

    #mass assignment protection
    #which value can be filled
    #prevent us from accidently writing field in our database that
    #we are not suppose to write, such as id which is an auto increment
    protected $fillable = [
        'name', 'image',
    ];
}
