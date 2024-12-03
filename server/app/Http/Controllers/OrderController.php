<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
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
        $orders = Order::with('items.product')->get();

        return response()->json([
            'error' => false,
            'message' => "get all order",
            'data' => $orders
        ], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "customer_name" => "required|string",
            "order_date" => "required|date",
            "items" => "present|array",
            "items.*.product_id" => "required|integer|exists:products,id",
            "items.*.quantity" => "required|numeric|gt:0",
        ]);

        $products = Product::get(['id', 'price', 'stock']);

        foreach ($request->items as $key => $value) {
            $overStock = $value["quantity"] > $products->find($value["product_id"])->stock;

            if ($overStock) {
                return response()->json([
                    "error" => "Insufficient stock for product ID " . $value['product_id'],
                ], 400);
            }
        }

        $order = Order::create([
            "customer_name" => $request->customer_name,
            "order_date" => $request->order_date,
        ]);

        foreach ($request->items as $key => $value) {
            $product = $products->find($value["product_id"]);

            $order->items()->create([
                'product_id' => $value["product_id"],
                'quantity' => $value["quantity"],
                'price' => $product->price,
            ]);

            $product->update([
                "stock" => $product->stock - $value["quantity"],
            ]);
        }

        return response()->json([
            'error' => false,
            'message' => "create product",
            'data' => $order,
        ], 201);
    }
}
