<?php

namespace App\Http\Controllers;

use App\Models\EmploiDuTemps;
use App\Models\Matiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EmploiDuTempsController extends Controller
{
    /**
     * Afficher l'emploi du temps pour un étudiant
     */
    public function indexEtudiant(): View
    {
        $jours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
        
        $emplois = EmploiDuTemps::where('actif', true)
            ->with(['matiere', 'professeur'])
            ->orderBy('heure_debut')
            ->get()
            ->groupBy('jour');

        return view('etudiant.emploi-du-temps', compact('emplois', 'jours'));
    }

    /**
     * Afficher la gestion de l'emploi du temps pour un professeur
     */
    public function indexProfesseur(): View
    {
        $jours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
        
        $emplois = EmploiDuTemps::where('professeur_id', Auth::id())
            ->with(['matiere'])
            ->orderBy('jour')
            ->orderBy('heure_debut')
            ->get();

        $matieres = Matiere::where('professeur_id', Auth::id())->get();

        return view('professeur.emploi-du-temps', compact('emplois', 'jours', 'matieres'));
    }

    /**
     * Formulaire de création
     */
    public function create(): View
    {
        $jours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
        $matieres = Matiere::where('professeur_id', Auth::id())->get();

        return view('professeur.emploi-create', compact('jours', 'matieres'));
    }

    /**
     * Enregistrer un nouvel emploi du temps
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'matiere_id' => 'required|exists:matieres,id',
            'jour' => 'required|in:lundi,mardi,mercredi,jeudi,vendredi,samedi',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i|after:heure_debut',
            'salle' => 'required|string|max:50',
            'classe' => 'nullable|string|max:50',
        ]);

        $validated['professeur_id'] = Auth::id();
        $validated['actif'] = true;

        EmploiDuTemps::create($validated);

        return redirect()->route('professeur.emploi')
            ->with('success', 'Cours ajouté à l\'emploi du temps!');
    }

    /**
     * Supprimer un cours
     */
    public function destroy(EmploiDuTemps $emploi)
    {
        if ($emploi->professeur_id !== Auth::id()) {
            abort(403);
        }

        $emploi->delete();

        return redirect()->route('professeur.emploi')
            ->with('success', 'Cours supprimé!');
    }
}
