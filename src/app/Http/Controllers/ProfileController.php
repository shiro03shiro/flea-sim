<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.show');
    }
    public function edit()
    {
        return view('profile.edit');
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
