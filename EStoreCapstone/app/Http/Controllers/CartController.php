<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingCart;
use App\Models\Item;

use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function index($id)
    {
        $shoppingCart = ShoppingCart::find($id);
        $item = $shoppingCart->item;

        return view('cart.index', ['shoppingCart' => $shoppingCart, 'item' => $item]);
    }
}
