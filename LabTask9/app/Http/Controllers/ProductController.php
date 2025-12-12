<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // 1. READ & SEARCH
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $products = Product::where('name', 'like', "%{$search}%")->get();
        } else {
            $products = Product::all();
        }

        return view('products.index', compact('products'));
    }

    // 2. CREATE FORM
    public function create()
    {
        return view('products.create');
    }

    // 3. STORE (With File Upload)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;

        if ($request->hasFile('image')) {
            // Stores in storage/app/public/products
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->save();
        return redirect('/products')->with('success', 'Product created successfully');
    }

    // 4. EDIT FORM
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }

    // 5. UPDATE
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;

        if ($request->hasFile('image')) {
            // Optional: Delete old image if exists
            if($product->image) {
                 Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->save();
        return redirect('/products');
    }

    // 6. DELETE
    public function destroy($id)
    {
        $product = Product::find($id);
        if($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect('/products');
    }
}