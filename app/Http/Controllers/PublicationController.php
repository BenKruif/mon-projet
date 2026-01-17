<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PublicationController extends Controller
{
    /**
     * Afficher les publications pour la page d'accueil
     */
    public function accueil(): View
    {
        $publicationsEpinglees = Publication::publiques()
            ->actives()
            ->epinglees()
            ->with('auteur')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $publications = Publication::publiques()
            ->actives()
            ->where('est_epingle', false)
            ->with('auteur')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('home', compact('publicationsEpinglees', 'publications'));
    }

    /**
     * Liste des publications pour le professeur
     */
    public function index(): View
    {
        $publications = Publication::where('auteur_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('professeur.publications', compact('publications'));
    }

    /**
     * Formulaire de création
     */
    public function create(): View
    {
        return view('professeur.publications-create');
    }

    /**
     * Enregistrer une nouvelle publication
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'categorie' => 'required|in:annonce,evenement,information,urgent',
            'est_public' => 'boolean',
            'est_epingle' => 'boolean',
            'date_expiration' => 'nullable|date|after:now',
        ]);

        $validated['auteur_id'] = Auth::id();
        $validated['est_public'] = $request->has('est_public');
        $validated['est_epingle'] = $request->has('est_epingle');
        $validated['date_publication'] = now();

        Publication::create($validated);

        return redirect()->route('professeur.publications')
            ->with('success', 'Publication créée avec succès!');
    }

    /**
     * Modifier une publication
     */
    public function edit(Publication $publication): View
    {
        if ($publication->auteur_id !== Auth::id()) {
            abort(403);
        }

        return view('professeur.publications-edit', compact('publication'));
    }

    /**
     * Mettre à jour une publication
     */
    public function update(Request $request, Publication $publication)
    {
        if ($publication->auteur_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'categorie' => 'required|in:annonce,evenement,information,urgent',
            'est_public' => 'boolean',
            'est_epingle' => 'boolean',
            'date_expiration' => 'nullable|date',
        ]);

        $validated['est_public'] = $request->has('est_public');
        $validated['est_epingle'] = $request->has('est_epingle');

        $publication->update($validated);

        return redirect()->route('professeur.publications')
            ->with('success', 'Publication mise à jour!');
    }

    /**
     * Supprimer une publication
     */
    public function destroy(Publication $publication)
    {
        if ($publication->auteur_id !== Auth::id()) {
            abort(403);
        }

        $publication->delete();

        return redirect()->route('professeur.publications')
            ->with('success', 'Publication supprimée!');
    }
}
