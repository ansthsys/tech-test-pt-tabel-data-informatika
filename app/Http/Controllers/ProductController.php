<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $products = Product::get(['id', 'name', 'price', 'stock']);

        return response()->json([
            'error' => false,
            'message' => "get all product",
            'data' => $products
        ], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "name" => "required|string|min:3",
            "price" => "required|numeric|min:1",
            "stock" => "required|numeric|gt:0",
        ]);

        $product = Product::create([
            "name" => $request->name,
            "price" => $request->price,
            "stock" => $request->stock,
        ]);

        return response()->json([
            'error' => false,
            'message' => "create product",
            'data' => $product
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                "error" => true,
                "message" => "id not found"
            ], 404);
        }

        $this->validate($request, [
            "name" => "nullable|string|min:3",
            "price" => "nullable|numeric|min:1",
            "stock" => "nullable|numeric|gt:0",
        ]);

        $product->update([
            "name" => $request->name ?? $product->name,
            "price" => $request->price ?? $product->price,
            "stock" => $request->stock ?? $product->stock,
        ]);

        return response()->json([
            'error' => false,
            'message' => "update product",
            'data' => $product
        ], 200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                "error" => true,
                "message" => "id not found"
            ], 404);
        }

        $product->delete();

        return response()->json([
            'error' => false,
            'message' => "delete product id $id",
        ], 200);
    }
}
