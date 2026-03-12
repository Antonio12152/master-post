<?php

namespace App\Http\Controllers;

/** @var \App\Models\User $user */

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Zeigt die Registrierungsseite an.
     *
     * @return \Illuminate\View\View
     */
    public function showRegister()
    {
        return view('auth.register');
    }
    /**
     * Zeigt die Login-Seite an.
     *
     * @return \Illuminate\View\View
     */
    public function showLogin()
    {
        return view('auth.login');
    }
    /**
     * Registriert einen neuen Benutzer, validiert die Eingaben, speichert ein Benutzer in der Datenbank 
     * und loggt ein Benutzer direkt ein.
     *
     * @param \Illuminate\Http\Request mixed $request
     * @return \Illuminate\Http\RedirectResponse
     */    

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'description' => 'string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'type' => 'required|in:user,admin'
        ]);

        $user = User::create($data);
        Auth::login($user);

        return redirect()->route('users.show', ['id' => $user->id]);
    }
    /**
     * Prüft die Login-Daten eines Benutzers, startet die Session bei Erfolg 
     * oder wirft eine ValidationException bei Fehlschlag.
     *
     * @param \Illuminate\Http\Request mixed $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect()->route('start');
        }
        throw ValidationException::withMessages(['credations' => 'Wrong email or password.']);
    }
    /**
     * Loggt den Benutzer aus, invalidiert die Session 
     * und regeneriert das CSRF-Token.
     *
     * @param \Illuminate\Http\Request mixed $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('start');
    }
}
