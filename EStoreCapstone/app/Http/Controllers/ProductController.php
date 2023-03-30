<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
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
}
