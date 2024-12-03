<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => ['index']
        ]);
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
        DB::beginTransaction();

        try {
            $validated = $this->validate($request, [
                'customer_name' => 'required|string|max:255',
                'order_date' => 'required|date',
                'items' => 'present|array|min:1',
                'items.*.product_id' => 'required|integer|exists:products,id',
                'items.*.quantity' => 'required|integer|min:1'
            ]);

            $total_price = 0;
            $order = new Order();
            $order->customer_name = $request->customer_name;
            $order->order_date = $request->order_date;  // Salah, harus pakai $request->order_date
            $order->save();

            foreach ($request->items as $item) {
                $product = Product::find($item['product_id']);

                if ($product->stock < $item['quantity']) {
                    return response()->json([
                        'error' => 'Insufficient stock for product'
                    ], 400);
                }

                $subtotal = intval($item["quantity"]) * intval($product->price);
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $product->id;
                $orderItem->quantity = $item['quantity'];
                $orderItem->price = $subtotal; // Salah, ini harus masuk di subtotal
                $orderItem->save();

                $total_price += $subtotal;

                $product->stock -= $item['quantity'];
                $product->save();
            }

            $order->total_price = $total_price;
            $order->save();

            DB::commit();

            return response()->json([
                'message' => 'Order created successfully'
            ], 201);
        } catch (\Exception $e) {
            // DB::rollBack();

            switch (get_class($e)) {
                case ValidationException::class:
                    return response()->json([
                        'error' => 'Validation Error',
                        'messages' => $e->errors(),
                    ], 422);
                case AuthenticationException::class:
                    return response()->json([
                        'error' => 'Authentication Error',
                        'message' => $e->getMessage(),
                    ], 401);
                case QueryException::class:
                    return response()->json([
                        'error' => 'Database Query Error',
                        'message' => $e->getMessage(),
                    ], 500);
                default:
                    return response()->json([
                        'error' => 'Server Error',
                        'message' => $e->getMessage(),
                    ], 500);
            }
        }
    }
}
