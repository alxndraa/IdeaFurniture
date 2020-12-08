<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productTypes = ProductType::all();
        return view('product.create', ['productTypes' => $productTypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
            'image' => 'mimes:jpeg,gif,png',
            'type' => 'required|exists:App\productType,id',
            'stock' => 'required|integer|min:1',
            'price' => 'required|integer|min:1',
            'desc' => 'required|min:15',
        ]);

        $product = new Product([
            'name' => $request['name'],
            'image' => $request['image'],
            'product_type_id' => $request['type'],
            'stock' => $request['stock'],
            'price' => $request['price'],
            'desc' => $request['desc'],
        ]);
        $product->save();

        return redirect()->route('homepage')->with([
            'message' => "<b>" . $product->name . "</b> has been successfully added"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $productTypes = ProductType::all();
        return view('product.edit', ['product' => $product, 'productTypes' => $productTypes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|min:5',
            'image' => 'mimes:jpeg,gif,png',
            'type' => 'required|exists:App\productType,id',
            'stock' => 'required|integer|min:1',
            'price' => 'required|integer|min:1',
            'desc' => 'required|min:15',
        ]);

        $product->update([
            'name' => $request['name'],
            'image' => $request['image'],
            'product_type_id' => $request['type'],
            'stock' => $request['stock'],
            'price' => $request['price'],
            'desc' => $request['desc'],
        ]);
        $product->save();

        return Redirect::action('ProductTypeController@show', $product->product_type_id)->with(
            'message', "<b>" . $product->name . "</b> has been successfully updated"
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $oldName = $product->name;
        $type = $product->product_type_id;
        $product->delete();
        
        return Redirect::action('ProductTypeController@show', $type)->with([
            'message' => "<b>" . $oldName . "</b> has been successfully deleted"
        ]);
    }
}
