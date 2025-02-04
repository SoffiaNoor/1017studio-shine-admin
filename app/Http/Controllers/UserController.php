<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Information;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'username' => 'required|string|max:50',
                'name' => 'required|string|max:255',
                'password' => 'required|string|min:8',
            ]);

            $input = $request->all();
            $input['username'] = $validatedData['username'];
            $input['password'] = Hash::make($input['password']);

            User::create($input);

            return redirect()->back()->with('success', 'Form filled out correctly! Ready to <a href="/login" style="font-style: italic;color:white">login</a>.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to register. Please input the right value!');
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginField = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginField => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials)) {
            return redirect('/')->with('success', 'Login successful');
        }

        return redirect('/login')->with('error', 'Email/Username or Password is incorrect');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
