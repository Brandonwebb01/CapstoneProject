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
        return view('productpage.index', ['categories' => $categories, 'items' => $items]);
    }
}
