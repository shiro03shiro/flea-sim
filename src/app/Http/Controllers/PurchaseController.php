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
        $item = Item::findOrFail($item_id);

        if ($item->sold_flg) {
            return redirect()->back()->with('error', '売り切れ商品です');
        }

        if ($item->user_id === Auth::id()) {
            return redirect()->back()->with('error', '自分の出品商品は購入できません');
        }

        return view('purchases.create', compact('item'));
    }

    public function store(Request $request, $item_id)
    {
        $item = Item::findOrFail($item_id);

        if ($item->sold_flg || $item->user_id === Auth::id()) {
            return redirect()->back()->with('error', '購入できない商品です');
        }

        Purchase::create([
            'user_id' => Auth::id(),
            'item_id' => $item_id,
        ]);

        $item->update(['sold_flg' => true]);

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
