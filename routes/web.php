<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\EmploiDuTempsController;
use App\Http\Controllers\AlerteController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\PublicationController;
use Illuminate\Support\Facades\Route;

// Page d'accueil publique avec les publications
Route::get('/', [PublicationController::class, 'accueil'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes dashboard séparées
    Route::get('/dashboard/etudiant', [DashboardController::class, 'etudiant'])
        ->name('dashboard.etudiant');

    Route::get('/dashboard/professeur', [DashboardController::class, 'professeur'])
        ->name('dashboard.professeur');

    // ==================== ROUTES ÉTUDIANT ====================
    Route::prefix('etudiant')->name('etudiant.')->group(function () {
        // Notes
        Route::get('/notes', [NoteController::class, 'indexEtudiant'])->name('notes');
        
        // Emploi du temps
        Route::get('/emploi-du-temps', [EmploiDuTempsController::class, 'indexEtudiant'])->name('emploi');
        
        // Alertes
        Route::get('/alertes', [AlerteController::class, 'indexEtudiant'])->name('alertes');
        Route::patch('/alertes/{alerte}/lu', [AlerteController::class, 'markAsRead'])->name('alertes.lu');
    });

    // ==================== ROUTES PROFESSEUR ====================
    Route::prefix('professeur')->name('professeur.')->group(function () {
        // Matières
        Route::get('/matieres', [MatiereController::class, 'index'])->name('matieres');
        Route::get('/matieres/create', [MatiereController::class, 'create'])->name('matieres.create');
        Route::post('/matieres', [MatiereController::class, 'store'])->name('matieres.store');
        Route::delete('/matieres/{matiere}', [MatiereController::class, 'destroy'])->name('matieres.destroy');

        // Notes
        Route::get('/notes', [NoteController::class, 'indexProfesseur'])->name('notes');
        Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
        Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
        Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');
        
        // Emploi du temps
        Route::get('/emploi-du-temps', [EmploiDuTempsController::class, 'indexProfesseur'])->name('emploi');
        Route::get('/emploi-du-temps/create', [EmploiDuTempsController::class, 'create'])->name('emploi.create');
        Route::post('/emploi-du-temps', [EmploiDuTempsController::class, 'store'])->name('emploi.store');
        Route::delete('/emploi-du-temps/{emploi}', [EmploiDuTempsController::class, 'destroy'])->name('emploi.destroy');
        
        // Alertes
        Route::get('/alertes', [AlerteController::class, 'indexProfesseur'])->name('alertes');
        Route::get('/alertes/create', [AlerteController::class, 'create'])->name('alertes.create');
        Route::post('/alertes', [AlerteController::class, 'store'])->name('alertes.store');
        Route::delete('/alertes/{alerte}', [AlerteController::class, 'destroy'])->name('alertes.destroy');

        // Publications
        Route::get('/publications', [PublicationController::class, 'index'])->name('publications');
        Route::get('/publications/create', [PublicationController::class, 'create'])->name('publications.create');
        Route::post('/publications', [PublicationController::class, 'store'])->name('publications.store');
        Route::get('/publications/{publication}/edit', [PublicationController::class, 'edit'])->name('publications.edit');
        Route::put('/publications/{publication}', [PublicationController::class, 'update'])->name('publications.update');
        Route::delete('/publications/{publication}', [PublicationController::class, 'destroy'])->name('publications.destroy');
    });
});

require __DIR__.'/auth.php';
