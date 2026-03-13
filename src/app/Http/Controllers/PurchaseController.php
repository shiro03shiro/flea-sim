<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PurchaseController extends Controller
{
    public function create($item_id)
    {
        $item = \App\Models\Item::findOrFail($item_id);
        return view('purchases.create', compact('item'));
    }

    public function store(Request $request, $item_id)
    {
        Purchase::create([
            'user_id' => Auth::id(),
            'item_id' => $item_id,
        ]);
        return redirect()->route('mypage')->with('success', '購入が完了しました！');
    }

    public function edit($item_id)
    {
        $item = Item::findOrFail($item_id);
        return view('purchases.edit', compact('item'));
    }

    public function update()
    {
        return redirect()->route('purchases.create');
    }

}
