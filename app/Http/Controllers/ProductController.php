<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //Middleware to limit the pages that guest can view
    //Guest and member can only view the show page and search page
    //Admin can accessed all the pages
    public function __construct()
    {
        $this->middleware('admin')->except(['show', 'search']);
    }
    
    //Show the form to create a new product
    public function create()
    {
        $productTypes = ProductType::all();
        return view('product.create', ['productTypes' => $productTypes]);
    }

    //Store the new product in storage
    public function store(Request $request)
    {
        $path = NULL;
        //Validate user input
        $request->validate([
            'name' => 'required|min:5',
            'image' => 'mimes:jpeg,gif,png|max:2000',
            'type' => 'required|exists:App\productType,id',
            'stock' => 'required|integer|min:1',
            'price' => 'required|integer|min:1',
            'desc' => 'required|min:15',
        ]);

        //Store image to storage
        if($request->image != NULL){
            $image = $request->file('image');
            $imagePath = Storage::disk('public')->put('assets/products', $image);
        }else{
            $imagePath = 'assets/no_img.png';
        }
        
        //Create a new product instance with the inputted values
        $product = new Product([
            'name' => $request['name'],
            'image' => $imagePath,
            'product_type_id' => $request['type'],
            'stock' => $request['stock'],
            'price' => $request['price'],
            'desc' => $request['desc'],
        ]);
        $product->save(); //save to database

        //redirect to homepage with a notification that the product has been added
        return redirect()->route('homepage')->with([
            'message' => "<b>" . $product->name . "</b> has been successfully added"
        ]);
    }

    //Display specific product
    public function show(Product $product)
    {
        return view('product.show', ['product' => $product]);
    }

    //Show the form to edit the specific product
    public function edit(Product $product)
    {
        $productTypes = ProductType::all();
        return view('product.edit', ['product' => $product, 'productTypes' => $productTypes]);
    }

    //Update the specific product in storage
    public function update(Request $request, Product $product)
    {
        //Validate the input
        $request->validate([
            'name' => 'required|min:5',
            'image' => 'mimes:jpeg,gif,png|max:2000',
            'type' => 'required|exists:App\productType,id',
            'stock' => 'required|integer|min:1',
            'price' => 'required|integer|min:1',
            'desc' => 'required|min:15',
        ]);

        //Update the product's values
        $product->update([
            'name' => $request['name'],
            'image' => $request['image'],
            'product_type_id' => $request['type'],
            'stock' => $request['stock'],
            'price' => $request['price'],
            'desc' => $request['desc'],
        ]);
        $product->save(); //Save to database

        //Redirect to the previous page which is a specific productType's page
        //with a success message
        return Redirect::action('ProductTypeController@show', $product->product_type_id)->with(
            'message', "<b>" . $product->name . "</b> has been successfully updated"
        );
    }

    //Remove a specific product
    public function destroy(Product $product)
    {
        //Initialized variable oldName's value with the product name
        //oldName will be used in the success message
        $oldName = $product->name;

        //delete image from storage
        Storage::disk('public')->delete($product->image);

        $product->delete(); //Delete the product from database
        
        //Redirect to a productType's show page with a success message
        return Redirect::back()->with([
            'message' => "<b>" . $oldName . "</b> has been successfully deleted"
        ]);
    }

    //Search for products that contain the inputted word(s)
    public function search(Request $request, $id){
        //Use eloquent to search for the products
        //Paginate the result per 10 products
        $productType = ProductType::find($id);
        $products = Product::where('name', 'like', "%$request->search%")->where('product_type_id', '=', "$id")->paginate(10);
        
        return view('productType.show', ['products' => $products, 'productType' => $productType]);
    }
}