<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(20);
        return view('list', compact('products'));
    }

    public function create()
    {
        return view('form');
    }

    public function store(Request $request)
    {
        // Validation and storing logic
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create($request->all());
        return redirect()->route('products');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('form', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return redirect()->route('products');
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('show', compact('product'));
    }

}
