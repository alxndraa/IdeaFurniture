<?php

namespace App\Http\Controllers;

use App\ProductType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        #uses all() eloquent function to retrieve all product types
        $productTypes = ProductType::all();
        return view('home', ['productTypes' => $productTypes]);
    }
}
