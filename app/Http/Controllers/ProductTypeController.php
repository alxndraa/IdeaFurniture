<?php

namespace App\Http\Controllers;

use App\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        #uses all() eloquent function to retrieve all product types
        $productTypes = ProductType::all();
        return view('productType.index', ['productTypes' => $productTypes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        #validation
        $request->validate([
            'name' => 'required|min:4',
        ]);

        #create a new instance of the product type model
        #give the instance the new value
        $productType = new ProductType([
            'name' => $request['name'],
            'image' => $request['image'],
        ]);
        $productType->save(); #save the instance

        #call the index method, go to the index view
        return $this->index()->with([
            'message' => "<b>" . $productType->name . "</b> has been successfully added"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function show(ProductType $productType)
    {
        $productType->products = $productType->products->toQuery()->paginate(10);
        return view('productType.show', ['productType' => $productType]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductType $productType)
    {
        return view('productType.edit', ['productType' => $productType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductType $productType)
    {
        $request->validate([
            'name' => 'required|min:4',
        ]);

        $productType->update([
            'name' => $request['name'],
            'image' => $request['image'],
        ]);
        $productType->save();

        return $this->index()->with([
            'message' => "<b>" . $productType->name . "</b> has been successfully updated"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductType $productType)
    {
        $oldName = $productType->name;
        $productType->delete();
        return $this->index()->with([
            'message' => "<b>" . $oldName . "</b> has been successfully deleted"
        ]);
    }
}
