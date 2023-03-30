<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $items = Item::orderBy('title','ASC')->paginate(10);
        return view('products.index', ['categories' => $categories, 'items' => $items]);
    }

    public function order($id)
    {
        $item = Item::find($id);
        return view('products.order', ['item' => $item]);
    }

    public function store(Request $request)
    {
            //validate the data
        $this->validate($request, [
            'item_id' => 'required|integer',
            'session_id' => 'required|string',
            'ip_address' => 'required|string',
            'quantity' => 'required|integer',
        ]); 
        // Create a new shopping cart item
        $shoppingCart = new ShoppingCart;
        $shoppingCart->item_id = $request->item_id;
        $shoppingCart->session_id = $request->session_id;
        $shoppingCart->ip_address = $request->ip_address;
        $shoppingCart->quantity = $request->quantity;
        $shoppingCart->save();

        // Redirect to the cart page
        return redirect()->route('cart.index');
    }

    public function show($id) {
        $item = Item::find($id);
        return view('products.show')->with('item', $item);
    }
}
