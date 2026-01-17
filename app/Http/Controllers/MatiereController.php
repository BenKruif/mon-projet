<?php

namespace App\Http\Controllers;

use App\Models\Matiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MatiereController extends Controller
{
    /**
     * Afficher les matières pour un professeur
     */
    public function index(): View
    {
        $matieres = Matiere::where('professeur_id', Auth::id())
            ->withCount('notes')
            ->get();

        return view('professeur.matieres', compact('matieres'));
    }

    /**
     * Formulaire de création
     */
    public function create(): View
    {
        return view('professeur.matieres-create');
    }

    /**
     * Enregistrer une nouvelle matière
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'code' => 'required|string|max:20|unique:matieres,code',
            'description' => 'nullable|string',
            'coefficient' => 'required|integer|min:1|max:10',
        ]);

        $validated['professeur_id'] = Auth::id();

        Matiere::create($validated);

        return redirect()->route('professeur.matieres')
            ->with('success', 'Matière créée avec succès!');
    }

    /**
     * Supprimer une matière
     */
    public function destroy(Matiere $matiere)
    {
        if ($matiere->professeur_id !== Auth::id()) {
            abort(403);
        }

        $matiere->delete();

        return redirect()->route('professeur.matieres')
            ->with('success', 'Matière supprimée!');
    }
}
