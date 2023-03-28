<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $items = Item::orderBy('title','ASC')->paginate(10);
       return view('items.index', ['categories' => $categories], ['items' => $items]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->sortBy('name');
        return view('items.create')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{ 
    //validate the data
    $this->validate($request, [
        'title' => 'required|string|max:255',
        'category_id' => 'required|integer|min:0',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
        'sku' => 'required|string|max:100',
        'picture' => 'required|image'
    ]); 

    //create a new item instance
    $item = new Item([
        'title' => $request->get('title'),
        'category_id' => $request->get('category_id'),
        'description' => $request->get('description'),
        'price' => $request->get('price'),
        'quantity' => $request->get('quantity'),
        'sku' => $request->get('sku')
    ]);

    //save image to storage
    //check if file is present
    if ($request->hasFile('picture')) {
        //retreieves uploaded image file and assigns it to a unique filename
        $image = $request->file('picture');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $location = 'images/items/' . $filename;

        //uses intervention image to create object from image
        $image = Image::make($image);
        
        //creates thumbnail from image
        $thumbnail = Image::make($image->encode());
        $thumbnail->resize(80, 80);
        //saves thumbnail to storage
        $thumbnail_location = 'images/items/tn' . $filename;

        //creates large image from image and sets constraints
        $lrg_image = Image::make($image->encode());
        $lrg_image->resize(400, 400);
        //saves large image to storage
        $larimg_location = 'images/items/lrg' . $filename;

        //saves all images to storage
        Storage::disk('public')->put($location, (string) $image->encode());
        Storage::disk('public')->put($thumbnail_location, (string) $thumbnail->encode());
        Storage::disk('public')->put($larimg_location, (string) $lrg_image->encode());

        $item->picture = $filename;
    }

    //save item to database
    $item->save();

    //redirect to items index page
    return redirect()->route('items.index')->with('success', 'Item has been added');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        $categories = Category::all()->sortBy('name');
        return view('items.edit')->with('item',$item)->with('categories',$categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validate the data
        // if fails, defaults to create() passing errors
        $item = Item::find($id);
        $this->validate($request, ['title'=>'required|string|max:255',
                                   'category_id'=>'required|integer|min:0',
                                   'description'=>'required|string',
                                   'price'=>'required|numeric',
                                   'quantity'=>'required|integer',
                                   'sku'=>'required|string|max:100',
                                   'picture' => 'sometimes|image']);             

        //send to DB (use ELOQUENT)
        $item->title = $request->title;
        $item->category_id = $request->category_id;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->quantity = $request->quantity;
        $item->sku = $request->sku;

        //save image
        if ($request->hasFile('picture')) {
            $image = $request->file('picture');

            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location ='images/items/' . $filename;

            $image = Image::make($image);
            Storage::disk('public')->put($location, (string) $image->encode());

            if (isset($item->picture)) {
                $oldFilename = $item->picture;
                Storage::delete('public/images/items/'.$oldFilename);                
            }

            $item->picture = $filename;
        }

        $item->save(); //saves to DB

        Session::flash('success','The item has been updated');

        //redirect
        return redirect()->route('items.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        if (isset($item->picture)) {
            $oldFilename = $item->picture;
            Storage::delete('public/images/items/'.$oldFilename);                
        }
        $item->delete();

        Session::flash('success','The item has been deleted');

        return redirect()->route('items.index');

    }

    public function order($id)
    {
        $item = Item::find($id);
        return view('items.order', compact('item'));
    }
}
