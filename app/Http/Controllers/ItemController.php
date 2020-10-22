<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::orderBy('id', 'desc')->paginate(10);
        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:191',
            'slug' => 'required|unique:items|min:3|max:191',
            'description' => 'required|min:10',
            'image' => 'required|mimes:png,jpeg|min:10',
            'price' => 'required|integer',
        ]);

        $image_name = time() . '.' . $request->image->extension();

        Item::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'image' => $image_name,
            'price' => $request->price,

        ]);

        //move = proses upload, public_path = masuk ke folder public lalu ke foler images -> items
        $request->image->move(public_path("images/items"), $image_name);

        return redirect()->route("items.index")->with("Success", "Created");
    }

    public function show(Item $item)
    {
        return view("items.show", compact("item"));
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
         $request->validate([
            'name' => 'required|min:3|max:191',
            'slug' => 'required|unique:items|min:3|max:191',
            'description' => 'required|min:10',
            'image' => 'required|mimes:png,jpeg|min:10',
            'price' => 'required|integer',
        ]);

         if ( ! empty($request->image) ) {
            if (file_exists(public_path("images/items/".$item->image))){
                unlink(public_path("images/items/".$item->image));
            }

            $image_name = time() . '.' . $request->image->extension();
            $request->image->move(public_path("images/items/"), $image_name);

            $data['image'] = $image_name;

         }

         $data['name'] = $request->name;
         $data['slug'] = $request->slug;
         $data['description'] = $request->description;
         $data['image'] = $image_name;
         $data['price'] = $request->price;

        $item->update($data);

        return redirect()->route("items.index")->with("Success", "Update Success.");
    }

    public function destroy(Item $item)
    {
        if (file_exists(public_path("images/items/".$item->image))) {
            unlink(public_path("images/items/".$item->image));
        }

        $item->delete();
        return redirect()->route("items.index")->with("Success", "Deleted");
    }
}
