<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return view('items.index');
    }

    public function show()
    {
        return view('items.show');
    }

    public function comment()
    {
        return view('items.show');
    }

    public function like()
    {
        return view('items.show');
    }

    public function unlike()
    {
        return view('items.show');
    }

    public function create()
    {
        return view('items.create');
    }

    public function store()
    {
        return redirect()->route('home')->with('success', '出品完了');
    }
}
