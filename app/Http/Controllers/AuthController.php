<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function showRegister(){
        return view('register');
    }

    public function register(Request $request){

        // Select from users where email = $email
        // This verify if the email already exist
        if(User::where('email', $request->email)->exists()){
            return back()->with('error', 'Email already exists');
        }

        if($request->password !== $request->confirmpassword){
            return back()->with('error', 'Passwords does not match');
        }

        User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Account has been sucessfully created');
    }

    public function showLogin(){
        return view('login');
    }

    public function login(Request $request){

        //Select from users where email 
        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return back()->with('error', 'Invalid credentials.');
        }
        
        session(['user' => $user]);

        return redirect('/dashboard')->with('success', 'Login successful');

    }

    public function logout(Request $request){
    $request->session()->forget('user');
    $request->session()->flush();
    return redirect('/login');
    }
    
}   
