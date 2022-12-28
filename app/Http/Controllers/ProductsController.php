<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index($category_slug)
    {
        $category = Category::where('slug', '=', $category_slug)
            ->firstOrFail();

        $products = $category->products()
            ->active()
            ->orderBy('price', 'DESC')
            ->with('category')
            ->get();
        
        return view('front.products.index', [
            'category' => $category,
            'products' => $products,
        ]);
    }
}