<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function users(){
        return $this->belongsTo(User::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    protected $fillable = [
        'user_id', 'date',
    ];

    public $timestamps = false;
}
