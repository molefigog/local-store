<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Flash\Flash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('edit-profile', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'nullable|string|max:255',
            // Add other validation rules for additional profile fields
            'email' => [
                Rule::unique('users', 'email')->ignore($user),
                'email',
            ],
            'password' => ['nullable'],
            'avatar' => ['image', 'max:1024'],
        ]);

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            // Add other profile fields as needed
        ]);

        if ($request->hasFile('avatar')) {
            // Validate the uploaded avatar
            $request->validate([
                'avatar' => ['image', 'max:1024'],
            ]);

            // Store the uploaded avatar and update the user's avatar column
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->update(['avatar' => $avatarPath]);
        }

        return redirect()->route('edit-profile')->with('success', 'Profile updated successfully!');
    }


    public function editPassword()
    {
        return view('edit-password');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The provided current password is incorrect.']);
        }

        User::where('id', $user->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('edit-password')->with('success', 'Password updated successfully!');
    }
}
