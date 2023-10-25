<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request) {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            Session::flash('error', 'Пользователь не найден');
            return redirect('/login');
        }

        if (Auth::attempt($validated)) {
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Неверный пароль',
        ])->onlyInput('email');
    }

    public function signup(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if ($user) {
            Session::flash('error', 'Пользователь уже существует');
            return redirect('/signup');
        }

        $user = User::create($validated);
        $user->save();

        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            return redirect()->intended('/dashboard');
        }

        return back();
    }
}
