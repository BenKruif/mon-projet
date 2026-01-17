<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Matiere;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NoteController extends Controller
{
    /**
     * Afficher les notes pour un étudiant
     */
    public function indexEtudiant(): View
    {
        $notes = Note::where('etudiant_id', Auth::id())
            ->with(['matiere', 'professeur'])
            ->orderBy('date_evaluation', 'desc')
            ->get();

        $moyenne = $notes->avg('note');

        return view('etudiant.notes', compact('notes', 'moyenne'));
    }

    /**
     * Afficher la gestion des notes pour un professeur
     */
    public function indexProfesseur(): View
    {
        $notes = Note::where('professeur_id', Auth::id())
            ->with(['etudiant', 'matiere'])
            ->orderBy('date_evaluation', 'desc')
            ->get();

        $matieres = Matiere::where('professeur_id', Auth::id())->get();
        $etudiants = User::where('role', 'etudiant')->get();

        return view('professeur.notes', compact('notes', 'matieres', 'etudiants'));
    }

    /**
     * Formulaire de création de note
     */
    public function create(): View
    {
        $matieres = Matiere::where('professeur_id', Auth::id())->get();
        $etudiants = User::where('role', 'etudiant')->get();

        return view('professeur.notes-create', compact('matieres', 'etudiants'));
    }

    /**
     * Enregistrer une nouvelle note
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'etudiant_id' => 'required|exists:users,id',
            'matiere_id' => 'required|exists:matieres,id',
            'note' => 'required|numeric|min:0|max:20',
            'type' => 'required|in:examen,devoir,tp,projet',
            'semestre' => 'nullable|string',
            'commentaire' => 'nullable|string',
            'date_evaluation' => 'required|date',
        ]);

        $validated['professeur_id'] = Auth::id();

        Note::create($validated);

        return redirect()->route('professeur.notes')
            ->with('success', 'Note ajoutée avec succès!');
    }

    /**
     * Supprimer une note
     */
    public function destroy(Note $note)
    {
        if ($note->professeur_id !== Auth::id()) {
            abort(403);
        }

        $note->delete();

        return redirect()->route('professeur.notes')
            ->with('success', 'Note supprimée avec succès!');
    }
}
