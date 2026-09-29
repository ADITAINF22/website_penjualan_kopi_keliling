<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:100'],
            'phone'         => ['required', 'string', 'max:20'],
            'address'       => ['required', 'string', 'max:255'],
            'note'          => ['nullable', 'string', 'max:500'],
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Keranjang masih kosong');
        }

        $products = Product::whereIn('id', array_keys($cart))
            ->where('is_available', true)
            ->get();

        if ($products->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Produk di keranjang sudah tidak tersedia');
        }

        $order = DB::transaction(function () use ($data, $products, $cart) {
            $qty = fn($p) => max(1, (int) ($cart[$p->id] ?? 1));

            $total = $products->sum(fn($p) => $p->price * $qty($p));

            $order = Order::create($data + [
                'total'   => $total,
                'channel' => 'online',
            ]);

            foreach ($products as $p) {
                $order->items()->create([
                    'product_id'   => $p->id,
                    'product_name' => $p->name,
                    'price'        => $p->price,
                    'quantity'     => $qty($p),
                ]);
            }

            return $order;
        });

        session()->forget('cart');

        return redirect()->away($this->whatsappUrl($order->load('items')));
    }

    private function whatsappUrl(Order $order): string
    {
        $lines = ["Halo Kopi Keliling, saya mau pesan (#{$order->id}):", ''];

        foreach ($order->items as $item) {
            $subtotal = number_format($item->price * $item->quantity, 0, ',', '.');
            $lines[] = "- {$item->product_name} x{$item->quantity} = Rp {$subtotal}";
        }

        $lines[] = '';
        $lines[] = 'Total: Rp ' . number_format($order->total, 0, ',', '.');
        $lines[] = "Nama: {$order->customer_name}";
        $lines[] = "HP: {$order->phone}";
        $lines[] = "Lokasi: {$order->address}";

        if ($order->note) {
            $lines[] = "Catatan: {$order->note}";
        }

        $number = preg_replace('/\D/', '', (string) config('services.whatsapp.number'));

        return "https://wa.me/{$number}?text=" . rawurlencode(implode("\n", $lines));
    }
}
