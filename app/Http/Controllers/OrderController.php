<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $cart = session()->get('cart');

        if (!$cart) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        $order = new Order();
        $order->user_id = Auth::id();
        $order->total_price = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));
        $order->save();

        foreach ($cart as $id => $details) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->food_id = $id;
            $orderItem->quantity = $details['quantity'];
            $orderItem->price = $details['price'];
            $orderItem->save();
        }

        session()->forget('cart');

        return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');
    }

    public function show($id)
    {
        $order = Order::with('orderItems.food')->findOrFail($id);
        return view('orders.show', compact('order'));
    }
}