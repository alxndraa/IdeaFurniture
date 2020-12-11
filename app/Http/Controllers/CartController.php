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

    public function index($id){
        $user = User::find($id);
        $products = Product::all();
        $cartItems = $user->products;

        return view('cart', ['cartItems' => $cartItems]);
    }

    public function attach(Request $request, $userId, $productId)
    {
        $product = Product::find($productId);
        $stock = $product->stock;

        $user = User::find($userId);

        $request->validate([
            'quantity' => ['required', 'numeric', 'min:1', 'max:' . $stock],
        ]);

        $product->users()->attach($userId,[
            'quantity' => $request['quantity'],
        ]);

        return back()->with([
            'message' => "<b>" . $product->name . "</b> has been added to your shopping cart"
        ]);
    }

    public function detach($userId, $productId)
    {
        $product = Product::find($productId);
        $product->users()->detach($userId);
        
        return back()->with([
            'message' => "<b>" . $product->name . "</b> has been removed from your shopping cart"
        ]);
    }
}
