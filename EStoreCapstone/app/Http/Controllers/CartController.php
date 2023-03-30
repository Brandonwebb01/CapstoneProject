<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }

    public function store(Request $request)
    {
        // Retrieve the necessary data from the request
        $item_id = $request->input('item_id');
        $session_id = $request->session()->getId();
        $ip_address = $request->ip();
        $quantity = $request->input('quantity') ?? 1;
        
        // Insert the item into the shopping cart
        DB::table('shopping_cart')->insert([
            'item_id' => $item_id,
            'session_id' => $session_id,
            'ip_address' => $ip_address,
            'quantity' => $quantity,
        ]);
        
        // Redirect the user back to the previous page
        return back();
    }
}
