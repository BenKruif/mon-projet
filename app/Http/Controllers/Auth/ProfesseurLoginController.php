<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfesseurLoginController extends Controller
{
    /**
     * Display the login view for professors.
     */
    public function create(): View
    {
        return view('auth.login-professeur');
    }

    /**
     * Handle an incoming authentication request for professors.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        // Vérifier que l'utilisateur est un professeur
        if (Auth::user()->role !== 'professeur') {
            Auth::logout();
            return redirect()->route('login.professeur')
                ->withErrors(['email' => 'Vous devez être un professeur pour accéder à cette page.']);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard.professeur', absolute: false));
    }
}
