<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;

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
            $items = Item::latest()->get();
        }

        return view('items.index', compact('items', 'tab'));
    }

    public function show($item_id)
    {
        $item = Item::with(['comments.user','likes'])->findOrFail($item_id);

        $liked = false;

        if(auth()->check()){
            $liked = $item->likes()->where('user_id',auth()->id())->exists();
        }

        return view('items.show', compact('item','liked'));
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

    public function like($item_id)
    {
        Like::create([
            'user_id' => auth()->id(),
            'item_id' => $item_id
        ]);

        return back();
    }

    public function unlike($item_id)
    {
        Like::where('user_id',auth()->id())
            ->where('item_id',$item_id)
            ->delete();

        return back();
    }

    public function create()
    {
        $categories = Category::all();

        return view('items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $path = $request->file('image')->store('items','public');

        Item::create([
            'user_id'=>auth()->id(),
            'name'=>$request->name,
            'brand_name'=>$request->brand_name,
            'price'=>$request->price,
            'description'=>$request->description,
            'condition'=>$request->condition,
            'image_path'=>$path,
            'sold_flg'=>false
        ]);

        return redirect('/');
    }
}
