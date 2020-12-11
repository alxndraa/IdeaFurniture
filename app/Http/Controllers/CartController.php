<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //only member that can access this
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function attach($userId, $productId, $amount){
        $product = Product::find($productId);
        $user = User::find($userId);

        $product->user()->attach($userId);
        
        return back()->with([
            'message' => "<b>" . $product->name . "</b> has been added to your shopping cart"
        ]);
    }

    public function detach($userId, $productId, $amount){
        $product = Product::find($productId);
        $user = User::find($userId);

        $product->user()->detach($userId);
        
        return back()->with([
            'message' => "<b>" . $product->name . "</b> has been removed from your shopping cart"
        ]);
    }
}
