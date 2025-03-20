<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $food = Food::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $food->name,
                "quantity" => 1,
                "price" => $food->price,
                "image" => $food->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Food added to cart successfully!');
    }

    public function viewCart()
    {
        $cart = session()->get('cart');
        return view('cart.view', compact('cart'));
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart');

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Food removed from cart successfully!');
    }
}