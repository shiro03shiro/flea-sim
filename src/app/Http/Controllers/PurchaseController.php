<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function create()
    {
        return view('purchases.create');
    }

    public function store()
    {
        return redirect()->route('home')->with('success', '購入完了');
    }

    public function edit()
    {
        return view('purchases.edit');
    }

    public function update()
    {
        return redirect()->route('purchases.create');
    }

}
