<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category($slug)
    {
        $categories = Category::all();
        
        $category = Category::where('slug', $slug)->firstOrFail();

        $products = Product::where('categories_id',$category->id)->get();

        return view('pages.prouct-category', compact('categories','products','category'));
    }
}
