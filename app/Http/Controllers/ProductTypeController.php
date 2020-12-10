<?php

namespace App\Http\Controllers;

use App\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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
        $imagePath = NULL;

        #validation
        $request->validate([
            'name' => 'required|min:4',
            'image' => 'mimes:jpeg,gif,png',
        ]);

        if($request->image != NULL){
            $image = $request->file('image');
            #$typeID = ProductType::all()->last()->id + 1;
            #$filename = $typeID . '.' . $image->extension();
            
            #$imagePath = Storage::disk('public')->putFileAs('assets/productTypes', $image, $filename);
            $imagePath = Storage::disk('public')->put('assets/productTypes', $image);
        }else{
            $imagePath = 'assets/no_img.png';
        }

        #create a new instance of the product type model
        #give the instance the new value
        $productType = new ProductType([
            'name' => $request['name'],
            'image' => $imagePath,
        ]);
        $productType->save(); #save the instance

        #call the index method, go to the index view
        return $this->index()->with([
            Session::put('message', "<b>" . $productType->name . "</b> has been successfully added")
            //'message' => "<b>" . $productType->name . "</b> has been successfully added"
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
        $products = $productType->products->toQuery()->paginate(10);
        return view('productType.show', ['products' => $products, 'productType' => $productType]);
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
            'image' => 'mimes:jpeg,gif,png|max:2M',
        ]);

        $productType->update([
            'name' => $request['name'],
            'image' => $request['image'],
        ]);
        $productType->save();

        return $this->index()->with([
            Session::put('message', "<b>" . $productType->name . "</b> has been successfully updated")
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

        //delete image from storage
        Storage::disk('public')->delete($productType->image);

        $productType->delete();
        
        return $this->index()->with([
            Session::put('message', "<b>" . $oldName . "</b> has been successfully deleted")
            //'message' => "<b>" . $oldName . "</b> has been successfully deleted"
        ]);
    }
}
