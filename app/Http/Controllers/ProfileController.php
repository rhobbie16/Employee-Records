<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
            'fullname'        => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email,' . $user->id,
            'contact'         => 'nullable|string|max:20',
            'gender'          => 'nullable|in:Male,Female',
            'address'         => 'nullable|string|max:500',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = User::findOrFail($user->id);

        // Upload image if there is a value
        if ($request->hasFile('profile_picture')) { // Checks if the input has a file

            // Delete old picture if it exists
            if ($user->profile_picture && file_exists(public_path($user->profile_picture))) {
                unlink(public_path($user->profile_picture));
            }

            // Gets the uploaded file and passes it to $file
            $file = $request->file('profile_picture');

            // Creates a unique file name using time() and passes it to $filename
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Moves file to folder 'uploads/profiles' in public folder
            $file->move(public_path('uploads/profiles'), $filename);

            // Saves filename to database
            $user->profile_picture = 'uploads/profiles/' . $filename;
        }

        // Updates fields in the database
        $user->fullname = $request->fullname;
        $user->email    = $request->email;
        $user->contact  = $request->contact;
        $user->gender   = $request->gender;
        $user->address  = $request->address;

        // Saves to database or apply all changes to database
        $user->save();

        // Refresh session to display the updated data
        session(['user' => $user]); // update session

        // Go back to same page with success message
        return back()->with('success', 'Profile updated successfully!');
    }
}