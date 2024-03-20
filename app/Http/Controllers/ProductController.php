<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchQuery = $request->searchQuery;
        $products = Product::when($searchQuery, function ($query) use ($request, $searchQuery) {
            $query->where('name', 'like', '%' . $searchQuery . '%')
                ->orWhere('description', 'like', '%' . $searchQuery . '%')
                ->orWhere('price', 'like', '%' . $searchQuery . '%');
        })->paginate(10);
        return response([
            'message' => 'Products retrieved successfully.',
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        return response([
            'message' => 'Product created successfully.',
            'product' => Product::create($request->validated())
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response([
            'message' => 'Product retrieved successfully.',
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {

        $product->update($request->all());
        return response([
            'message' => 'Product updated successfully.',
            'product' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response([
            'message' => 'Product deleted successfully.'
        ]);
    }
}
