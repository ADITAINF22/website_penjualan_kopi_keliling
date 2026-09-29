<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();

        $items = $products->map(fn($p) => [
            'product'  => $p,
            'qty'      => $cart[$p->id],
            'subtotal' => $p->price * $cart[$p->id],
        ]);

        $total = $items->sum('subtotal');

        return view('cart', compact('items', 'total'));
    }

    public function add(Product $product)
    {
        abort_unless($product->is_available, 404);

        $cart = session('cart', []);
        $cart[$product->id] = min(($cart[$product->id] ?? 0) + 1, 20);
        session(['cart' => $cart]);

        return back()->with('success', $product->name . ' masuk keranjang');
    }

    public function update(Request $request, Product $product)
    {
        $qty = (int) $request->input('quantity');
        $cart = session('cart', []);

        if ($qty > 0) {
            $cart[$product->id] = min($qty, 20);
        } else {
            unset($cart[$product->id]);
        }

        session(['cart' => $cart]);

        return back();
    }

    public function remove(Product $product)
    {
        $cart = session('cart', []);
        unset($cart[$product->id]);
        session(['cart' => $cart]);

        return back();
    }
}
