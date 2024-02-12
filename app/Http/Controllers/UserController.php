<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return 'Hello, madlang pipol! Mabuhay!';
    }

    public function login()
    {
        if (View::exists('user.login')) {
            return view('user.login');
        } else {
            return response()->view('errors.404');
        }
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            "email" => ['required', 'email'],
            "password" => 'required'
        ]);

        if(auth()->attempt($validated))
        {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'Welcome back!');
        }

        return back()->withErrors(['email' => 'Login failed.'])->onlyInput('email');
    }

    public function register()
    {
        return view('user.register');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with('message', 'Logout successful!');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => ['required', 'min:4'],
            "email" => ['required', 'email', Rule::unique('users', 'email')],
            "password" => 'required|confirmed|min:6'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        auth()->login($user);

        return redirect('/')->with('message', 'Successful registration!');
    }

    public function show($id)
    {
        $data = array(
            "id" => $id,
            "name" => "Somethinh Name",
            "age" => 20,
            "email" => "sample@mail.com"
        );

        return view('user',  $data);
    }
}
