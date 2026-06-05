<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = session('user');
        return view('profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = session('user');

        $request->validate([
            'fullname'         => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email,' . $user->id,
            'contact'          => 'nullable|string|max:20',
            'gender'           => 'nullable|in:Male,Female',
            'address'          => 'nullable|string|max:500',
            'profile_picture'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'current_password' => 'nullable',
            'new_password'     => 'nullable|min:6|confirmed',
        ]);

        $user = User::findOrFail($user->id);

        // Profile picture upload
        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture && file_exists(public_path($user->profile_picture))) {
                unlink(public_path($user->profile_picture));
            }
            $file = $request->file('profile_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profiles'), $filename);
            $user->profile_picture = 'uploads/profiles/' . $filename;
        }

        // Password change
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->with('error', 'Current password is incorrect.');
            }
            if ($request->filled('new_password')) {
                $user->password = Hash::make($request->new_password);
                $user->save();
                session(['user' => $user]);
                return back()->with('success', 'Password has been successfully changed.');
            }
        }

        // Update fields
        $user->fullname = $request->fullname;
        $user->email    = $request->email;
        $user->contact  = $request->contact;
        $user->gender   = $request->gender;
        $user->address  = $request->address;

        $user->save();

        session(['user' => $user]);

        return back()->with('success', 'Profile updated successfully!');
    }
}