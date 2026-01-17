<?php

namespace App\Http\Controllers;

use App\Models\Alerte;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AlerteController extends Controller
{
    /**
     * Afficher les alertes pour un étudiant
     */
    public function indexEtudiant(): View
    {
        $alertes = Alerte::pourUtilisateur(Auth::id())
            ->with('auteur')
            ->orderBy('created_at', 'desc')
            ->get();

        $nonLues = $alertes->where('lu', false)->count();

        return view('etudiant.alertes', compact('alertes', 'nonLues'));
    }

    /**
     * Afficher la gestion des alertes pour un professeur
     */
    public function indexProfesseur(): View
    {
        $alertes = Alerte::where('auteur_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        $etudiants = User::where('role', 'etudiant')->get();

        return view('professeur.alertes', compact('alertes', 'etudiants'));
    }

    /**
     * Formulaire de création d'alerte
     */
    public function create(): View
    {
        $etudiants = User::where('role', 'etudiant')->get();

        return view('professeur.alertes-create', compact('etudiants'));
    }

    /**
     * Enregistrer une nouvelle alerte
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:changement_salle,disponibilite,paiement,general',
            'priorite' => 'required|in:basse,moyenne,haute,urgente',
            'destinataire_id' => 'nullable|exists:users,id',
            'pour_tous' => 'boolean',
            'date_expiration' => 'nullable|date|after:now',
        ]);

        $validated['auteur_id'] = Auth::id();
        $validated['pour_tous'] = $request->has('pour_tous');

        Alerte::create($validated);

        return redirect()->route('professeur.alertes')
            ->with('success', 'Alerte envoyée avec succès!');
    }

    /**
     * Marquer une alerte comme lue
     */
    public function markAsRead(Alerte $alerte)
    {
        $alerte->update(['lu' => true]);

        return back();
    }

    /**
     * Supprimer une alerte
     */
    public function destroy(Alerte $alerte)
    {
        if ($alerte->auteur_id !== Auth::id()) {
            abort(403);
        }

        $alerte->delete();

        return redirect()->route('professeur.alertes')
            ->with('success', 'Alerte supprimée!');
    }
}
