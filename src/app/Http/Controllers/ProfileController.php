<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;

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
    public function update(Request $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            // 他のプロフィール項目...
            'is_profile_completed' => true,  // ← ここで完了フラグON
        ]);

        return redirect()->route('home');
    }
}
