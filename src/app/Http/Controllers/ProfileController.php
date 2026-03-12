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
            $purchasedItems = $user->purchases()->with('item.categories')->latest()->paginate(10);
            $soldItems = collect();
        } elseif ($request->get('page') === 'sell') {
            $soldItems = $user->items()->with('categories')->latest()->paginate(10);
            $purchasedItems = collect();
        } else {
            $soldItems = $user->items()->with('categories')->latest()->take(10)->get();
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
            'building' => $request->building ?? null,
        ];

        if ($request->hasFile('avatar_path')) {
            if ($user->profile && $user->profile->avatar_path) {
                \Storage::disk('public')->delete($user->profile->avatar_path);
            }
            $avatarPath = $request->file('avatar_path')->store('avatars', 'public');
            $profileData['avatar_path'] = $avatarPath;
        }

        $user->profile()->updateOrCreate(['user_id' => $user->id], $profileData);
        return redirect()->route('profile.show')->with('success', 'プロフィールが更新されました');
    }
}
