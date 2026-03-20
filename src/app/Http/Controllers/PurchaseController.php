<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use App\Http\Requests\AddressRequest;
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

        $paymentMethod = (int) $request->input('payment_method', 1);

        Purchase::create([
            'user_id' => Auth::id(),
            'item_id' => $item_id,
            'payment_method' => $paymentMethod,
        ]);

        $item->update(['sold_flg' => true]);

        return redirect()->route('profile.show')->with('success', '購入が完了しました！');
    }

    public function edit($item_id)
    {
        $item = Item::findOrFail($item_id);
        $profile = auth()->user()->profile;
        return view('purchases.edit', compact('item', 'profile'));
    }

    public function update(AddressRequest $request, $item_id)
    {
        $profileData = $request->validated();

        $user = auth()->user();
        $user->profile()->updateOrCreate(['user_id' => $user->id], $profileData);

        $redirectTo = $request->input('redirect_to') ?: route('purchases.create', $item_id);
        return redirect($redirectTo)->with('success', '住所を更新しました');
    }
}
