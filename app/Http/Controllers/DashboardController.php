<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the student dashboard.
     */
    public function etudiant(): View
    {
        // Vérifier que l'utilisateur est un étudiant
        if (Auth::user()->role !== 'etudiant') {
            abort(403, 'Accès non autorisé. Vous devez être un étudiant.');
        }

        return view('dashboard-etudiant');
    }

    /**
     * Display the professor dashboard.
     */
    public function professeur(): View
    {
        // Vérifier que l'utilisateur est un professeur
        if (Auth::user()->role !== 'professeur') {
            abort(403, 'Accès non autorisé. Vous devez être un professeur.');
        }

        return view('dashboard-professeur');
    }
}
