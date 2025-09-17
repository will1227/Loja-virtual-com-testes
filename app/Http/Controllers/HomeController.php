<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Type; 

class HomeController extends Controller
{
    public function index()
    {
        $type_id = request('type_id'); 

        $types = Type::all(); 

        if ($type_id) {
            $products = Product::where('type_id', $type_id)->get();
        } else {
            $products = Product::all();
        }

        return view('home', compact('products', 'types', 'type_id'));
    }
}
