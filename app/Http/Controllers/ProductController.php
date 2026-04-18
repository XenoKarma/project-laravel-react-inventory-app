<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'supplier'])->get();

        return response()->json([
            'success' => true,
            'message' => 'Product list',
            'data' => $products
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        $product = Product::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'data' => $product
        ]);
    }

    public function show($id)
    {
        $product = Product::with(['category', 'supplier'])->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product details',
            'data' => $product
        ]);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);
        }

        $validated = $request->validated();

        $product->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
            'data' => $product
        ]);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully',
        ]);
    }
}
