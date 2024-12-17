<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $products = Product::all(); // Fetch all products
    return view('products.index', compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'categories' => 'nullable|string|max:255',
                'stock_status' => 'required|in:In-Stock,Out of Stock',
            ]);

            if ($request->hasFile('image')) {
                if (!Storage::disk('public')->exists('products')) {
                    Storage::disk('public')->makeDirectory('products');
                }
                $validated['image'] = $request->file('image')->store('products', 'public');
            }

            Product::create($validated);

            return redirect()->route('products.index')->with('success', 'Product created successfully.');
        } catch (Exception $e) {
            return redirect()->route('products.create')->with('error', 'Failed to create product.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        try {
            return view('show', compact('product'));
        } catch (Exception $e) {
            return redirect()->route('show')->with('error', 'Failed to retrieve product.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        try {
            return view('products.update', compact('product'));
        } catch (Exception $e) {
            return redirect()->route('products.update', $product->id)->with('error', 'Failed to retrieve product for editing.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'categories' => 'nullable|string|max:255',
                'stock_status' => 'required|in:In-Stock,Out of Stock',
            ]);

            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
                $validated['image'] = $request->file('image')->store('products', 'public');
            }

            $product->update($validated);

            return redirect()->route('products.index')->with('success', 'Product updated successfully.');
        } catch (Exception $e) {
            return redirect()->route('products.edit', $product->id)->with('error', 'Failed to update product.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $product->delete();

            return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('products.index')->with('error', 'Failed to delete product.');
        }
    }

    public function userproducts()
    {
        try {
            $products = Product::where('stock_status', 'In-Stock')->get();
            return view('products-user', compact('products'));
        } catch (Exception $e) {
            return redirect()->route('products-user')->with('error', 'Failed to retrieve user products.');
        }
    }

    public function search(Request $request)
    {
        try {
            $query = Product::where('stock_status', 'In-Stock');

            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->input('name') . '%');
            }

            if ($request->filled('categories')) {
                $query->where('categories', 'like', '%' . $request->input('categories') . '%');
            }

            $products = $query->get();

            return view('products-user', compact('products'));
        } catch (Exception $e) {
            return redirect()->route('products.user')->with('error', 'Failed to search products.');
        }
    }
}