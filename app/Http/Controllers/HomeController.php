<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\RouteStop;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('is_available', true)->get();
        $stops = RouteStop::orderBy('day')->orderBy('start_time')->get();
        $hari = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];

        return view('home', compact('products', 'stops', 'hari'));
    }
}
