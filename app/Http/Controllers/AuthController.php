<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /* ═══════════════════════════
       LOGIN
    ═══════════════════════════ */
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required'    => 'E-Mail-Adresse ist erforderlich.',
            'email.email'       => 'Bitte eine gültige E-Mail-Adresse eingeben.',
            'password.required' => 'Passwort ist erforderlich.',
            'password.min'      => 'Das Passwort muss mindestens 6 Zeichen haben.',
        ]);

        $credentials = $request->only('email', 'password');
        $remember    = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')
                             ->with('success', 'Willkommen zurück, ' . Auth::user()->name . '! 👋');
        }

        return back()
            ->withInput($request->only('email'))
            ->with('error', 'E-Mail oder Passwort ist falsch.');
    }

    /* ═══════════════════════════
       REGISTER
    ═══════════════════════════ */
    public function register()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'vorname'               => 'required|string|max:100',
            'nachname'              => 'required|string|max:100',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|min:8|confirmed',
        ], [
            'vorname.required'              => 'Vorname ist erforderlich.',
            'nachname.required'             => 'Nachname ist erforderlich.',
            'email.required'                => 'E-Mail-Adresse ist erforderlich.',
            'email.email'                   => 'Bitte eine gültige E-Mail-Adresse eingeben.',
            'email.unique'                  => 'Diese E-Mail-Adresse ist bereits registriert.',
            'password.required'             => 'Passwort ist erforderlich.',
            'password.min'                  => 'Das Passwort muss mindestens 8 Zeichen haben.',
            'password.confirmed'            => 'Die Passwörter stimmen nicht überein.',
        ]);

        $user = User::create([
            'name'     => $request->vorname . ' ' . $request->nachname,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')
                         ->with('success', 'Willkommen bei CareerHub, ' . $user->name . '! 🎉');
    }

    /* ═══════════════════════════
       LOGOUT
    ═══════════════════════════ */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
                         ->with('success', 'Du wurdest erfolgreich abgemeldet.');
    }
}
