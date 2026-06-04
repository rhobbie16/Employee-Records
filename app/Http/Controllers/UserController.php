<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showUser()
    {
        $user = User::all();
        return view('user', compact('user'));
    }

    public function store(Request $request)
    {
    $request->validate([
        'fullname' => 'required',
        'email'    => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
        'role'     => 'required',
    ]);

    User::create([
        'fullname' => $request->fullname,
        'email'    => $request->email,
        'contact'  => $request->contact,
        'password' => Hash::make($request->password),
        'role'     => $request->role,
    ]);

    return redirect()->route('user')->with('success', 'User added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fullname' => 'required',
            'email'    => 'required|email|unique:users,email,' . $id,
            'role'     => 'required',
        ]);

        User::findOrFail($id)->update($request->only('fullname', 'email', 'contact', 'role'));

        return redirect()->route('user')->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('user')->with('success', 'User deleted successfully!');
    }
}