<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\ExhibitionRequest;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab');

        if ($tab === 'mylist' && auth()->check()) {
            $items = Item::whereHas('likes', function ($query) {
                $query->where('user_id', auth()->id());
            })->latest()->get();
        } else {
            $query = auth()->check() ? Item::where('user_id', '!=', auth()->id()) : Item::query();
            $items = $query->latest()->get();
        }

        return view('items.index', compact('items', 'tab'));
    }

    public function show($id)
    {
        $item = \App\Models\Item::findOrFail($id);

        return view('items.show', compact('item'));
    }

    public function comment(Request $request,$item_id)
    {
        Comment::create([
            'user_id'=>auth()->id(),
            'item_id'=>$item_id,
            'content'=>$request->content
        ]);

        return back();
    }





    public function create()
    {
        $categories = Category::all();

        return view('items.create', compact('categories'));
    }

    public function store(ExhibitionRequest $request)
    {
        $path = null;
        if ($request->hasFile('image_path') && $request->file('image_path')->isValid()) {
            $path = $request->file('image_path')->store('items', 'public');
        }

        $item = Item::create([
            'user_id'=>auth()->id(),
            'image_path'=>$path,
            'name'=>$request->name,
            'brand_name'=>$request->brand_name,
            'price'=>$request->price,
            'description'=>$request->description,
            'condition'=>$request->condition,
            'sold_flg'=>false
        ]);

        $item->categories()->attach($request->category_id);

        return redirect('/');
    }
}
