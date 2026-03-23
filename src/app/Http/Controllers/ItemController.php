<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\ExhibitionRequest;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Str;


class ItemController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab');

        if ($tab === 'mylist' && !auth()->check()) {
            $items = Item::whereRaw('1=0')->paginate(1);
            $items->setCollection(collect());
        } elseif ($tab === 'mylist') {
            $items = Item::whereHas('likes', function ($query) {
                $query->where('user_id', auth()->id());
            })->latest()->paginate(30);
        } else {
            $query = auth()->check() ? Item::where('user_id', '!=', auth()->id()) : Item::query();
            $items = $query->latest()->paginate(30);
        }

        return view('items.index', compact('items', 'tab'));
    }

    public function show($id)
    {
        $item = Item::with(['comments.user.profile'])
                    ->withCount('likes', 'comments')
                    ->findOrFail($id);

        return view('items.show', compact('item'));
    }

    public function comment(CommentRequest $request,$item_id)
    {
        Comment::create([
            'user_id'=>auth()->id(),
            'item_id'=>$item_id,
            'content'=>$request->content,
        ]);

        return back();
    }

    public function like($item_id)
    {
        $item = Item::findOrFail($item_id);
        if ($item->user_id === auth()->id()) {
            return back()->with('error', '自分の出品商品にはいいねできません');
        }
        $item->likes()->attach(auth()->id());
        return back();
    }

    public function unlike($item_id)
    {
        $item = Item::findOrFail($item_id);
        if ($item->user_id === auth()->id()) {
            return back();
        }
        $item->likes()->detach(auth()->id());
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
        elseif ($request->filled('image_path') && !Str::startsWith($request->image_path, ['http://', 'https://'])) {
            $path = null;
        } else {
            $path = $request->image_path;
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
