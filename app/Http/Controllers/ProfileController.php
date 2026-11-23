<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::user();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'user' => $user,
            ]);
        }

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
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:30',
            'bio' => 'nullable|string|max:1000',
            'password' => 'nullable|string|min:6',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:10240',
        ], [
            'name.required' => 'សូមបញ្ចូលឈ្មោះរបស់អ្នក។',
            'email.required' => 'សូមបញ្ចូលអ៊ីមែលរបស់អ្នក។',
            'email.email' => 'ទម្រង់អ៊ីមែលមិនត្រឹមត្រូវឡើយ។',
            'email.unique' => 'អ៊ីមែលនេះមានក្នុងប្រព័ន្ធរួចហើយ។',
            'password.min' => 'ពាក្យសម្ងាត់ត្រូវមានយ៉ាងតិច ៦ តួអក្សរ។',
            'avatar.uploaded' => 'ការផ្ទុកឡើងរូបភាពមិនបានសម្រេច (ទំហំរូបភាពអាចធំជាងកំណត់)។ សូមជ្រើសរើសរូបភាពក្រោម 10MB។',
            'avatar.image' => 'ឯកសារដែលបានជ្រើសរើសត្រូវតែជារូបភាព។',
            'avatar.mimes' => 'ទម្រង់រូបភាពត្រូវតែជា JPG, JPEG, PNG, WEBP ឬ GIF។',
            'avatar.max' => 'ទំហំរូបភាពមិនត្រូវលើសពី 10MB ឡើយ។',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('avatar')) {
            // store new avatar in storage/app/public/avatars
            $path = $request->file('avatar')->store('avatars', 'public');

            // delete old avatar if exists and not default/external
            if (!empty($user->avatar) && !filter_var($user->avatar, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $data['avatar'] = $path;
        }

        $user->update($data);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully.',
                'user' => $user->fresh(),
            ]);
        }

        return redirect()->route('profile.show')->with('success', 'ព័ត៌មានប្រវត្តិរូបត្រូវបានកែប្រែដោយជោគជ័យ។');
    }

    // optional admin dashboard
    public function adminDashboard()
    {
        $user = Auth::user();
        return view('admin.dashboard', compact('user'));
    }


}
