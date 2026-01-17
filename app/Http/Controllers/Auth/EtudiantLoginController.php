<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EtudiantLoginController extends Controller
{
    /**
     * Display the login view for students.
     */
    public function create(): View
    {
        return view('auth.login-etudiant');
    }

    /**
     * Handle an incoming authentication request for students.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        // Vérifier que l'utilisateur est un étudiant
        if (Auth::user()->role !== 'etudiant') {
            Auth::logout();
            return redirect()->route('login.etudiant')
                ->withErrors(['email' => 'Vous devez être un étudiant pour accéder à cette page.']);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard.etudiant', absolute: false));
    }
}
