<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller
{
      public function show()
    {
        $user = Auth::user();

        // if you want separate admin profile page, redirect:
        if ($user->isAdmin()) {
            // either return same view with admin flag,
            // or redirect to admin dashboard
            return view('profile.show', ['user' => $user, 'isAdmin' => true]);
        }

        return view('profile.show', ['user' => $user, 'isAdmin' => false]);
    }

    

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

     public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|max:2048', // optional
        ]);

        if ($request->hasFile('avatar')) {
            // store new avatar in storage/app/public/avatars
            $path = $request->file('avatar')->store('avatars', 'public');

            // delete old avatar if exists
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $data['avatar'] = $path;
        }

        $user->update($data);

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }

    // optional admin dashboard
    public function adminDashboard()
    {
        $user = Auth::user();
        return view('admin.dashboard', compact('user'));
    }


}
