<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ShoppingCart;
use App\Models\Item;

use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function index($id = null)
    {
        if ($id) {
        // Get the shopping cart item
        $shoppingCart = ShoppingCart::find($id);
        // Get the item associated with the shopping cart item
        $item = $shoppingCart->item;

        return view('cart.index', ['shoppingCart' => $shoppingCart, 'item' => $item]);
    } else {
        // If no ID was provided, return a view with a message indicating that no item was selected
        return view('cart.index', ['message' => 'Please select an item to view']);
    }
    }
}
