<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        // Pass the cart data to the view
        return view('cart.index');
    }
}
