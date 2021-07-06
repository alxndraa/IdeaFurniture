<?php

namespace App\Http\Controllers;

use App\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductTypeController extends Controller
{
    //Middleware to limit the pages that guest can access
    //Guest and member can only view the index page and show page
    //Admin can accessed all the pages
    public function __construct()
    {
        $this->middleware('admin')->except(['index', 'show']);
    }

    //Show the form to create a new product type
    public function create()
    {
        return view('productType.create');
    }

    //Store the newly created product type in storage
    public function store(Request $request)
    {
        $imagePath = NULL;

        #validation
        $request->validate([
            'name' => 'required|min:4',
            'image' => 'mimes:jpeg,gif,png|max:2000',
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

    //Display certain productType's products
    //Ex: products that is classified as bed frames
    public function show(ProductType $productType)
    {
        $products = $productType->products->toQuery()->paginate(12);
        return view('productType.show', ['products' => $products, 'productType' => $productType]);
    }

    //Show the form to edit a specific product type
    public function edit(ProductType $productType)
    {
        return view('productType.edit', ['productType' => $productType]);
    }

    //update the productType's value in storage
    public function update(Request $request, ProductType $productType)
    {
        $request->validate([
            'name' => 'required|min:4',
            'image' => 'mimes:jpeg,gif,png|max:2000',
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

        $productType->update([
            'name' => $request['name'],
            'image' => $imagePath,
        ]);
        $productType->save(); #save the instance

        $productType->update([
            'name' => $request['name'],
            'image' => $request['image'],
        ]);
        $productType->save();

        return $this->index()->with([
            Session::put('message', "<b>" . $productType->name . "</b> has been successfully updated")
        ]);
    }
    
    //Remove specific productType
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
