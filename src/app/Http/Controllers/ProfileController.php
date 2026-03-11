<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = auth()->user();
        $profile = $user->profile;

        if ($request->get('page') === 'buy') {
            $purchasedItems = $user->purchases()->with('item.category')->latest()->paginate(10);
            $soldItems = collect();
        } elseif ($request->get('page') === 'sell') {
            $soldItems = $user->items()->with('category')->latest()->paginate(10);
            $purchasedItems = collect();
        } else {
            $soldItems = $user->items()->with('category')->latest()->take(10)->get();
            $purchasedItems = collect();
        }
        return view('profile.show', compact('user', 'profile', 'soldItems', 'purchasedItems'));
    }
    public function edit()
    {
        $user = auth()->user();
        $profile = $user->profile;
        return view('profile.edit', compact('user', 'profile'));
    }
    public function update(ProfileRequest $request, User $user)
    {
        $user = auth()->user();

        $user->update([
            'name' => $request->name,
            'is_profile_completed' => true,
        ]);
        $profileData = [
            'postal_code' => $request->postal_code,
            'address' => $request->address,
        ];

        if ($request->hasFile('avatar_path')) {
            $avatarPath = $request->file('avatar_path')->store('avatars', 'public');
            $user->avatar_path = $avatarPath;
        }

        $user->profile()->updateOrCreate(['user_id' => $user->id], $profileData);
        return redirect()->route('home');
    }
}
