<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = product::all();
        return view('products.index', compact('products'));
    }
    public function show($name, Request $request)
    {   
        $errors['name']  = '';
        $errors['card']  = '';
        $errors['cvv']   = '';
        $errors['month'] = '';
        $errors['year']  = '';
        
        $product = product::where('name',$name)->first();
        return view('products.show', compact('product', 'errors'));
    }
}
