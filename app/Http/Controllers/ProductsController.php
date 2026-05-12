<?php

namespace App\Http\Controllers;
use App\Models\Products;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    // home page
    public function home(){
        $products = Products::orderBy('id','ASC')->get();

        $menu = [
            ['id'=>1,'name'=>'Home','url'=>'/'],
            ['id'=>2,'name'=>'Products','url'=>'/view-product'],
        ];

        return view('Frontend.home', compact('products', 'menu'));
    }

      public function index()
    {
        return view('Frontend.index');
    }
}