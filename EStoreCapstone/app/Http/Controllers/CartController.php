<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index($id)
    {
        // Use the $id parameter here to fetch the corresponding shopping cart
        $cart = ShoppingCart::find($id);

        // Pass the cart data to the view
        return view('cart.index', ['cart' => $cart]);
    }
}
