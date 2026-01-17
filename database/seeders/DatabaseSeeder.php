<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Matiere;
use App\Models\Note;
use App\Models\EmploiDuTemps;
use App\Models\Alerte;
use App\Models\Publication;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer un professeur
        $professeur = User::create([
            'name' => 'Prof. Jean Dupont',
            'email' => 'professeur@ecole.com',
            'password' => Hash::make('password'),
            'role' => 'professeur',
        ]);

        // Créer des étudiants
        $etudiant1 = User::create([
            'name' => 'Marie Martin',
            'email' => 'etudiant@ecole.com',
            'password' => Hash::make('password'),
            'role' => 'etudiant',
        ]);

        $etudiant2 = User::create([
            'name' => 'Pierre Durand',
            'email' => 'pierre.durand@ecole.com',
            'password' => Hash::make('password'),
            'role' => 'etudiant',
        ]);

        $etudiant3 = User::create([
            'name' => 'Sophie Bernard',
            'email' => 'sophie.bernard@ecole.com',
            'password' => Hash::make('password'),
            'role' => 'etudiant',
        ]);

        // Créer des matières
        $matiere1 = Matiere::create([
            'nom' => 'Programmation Web',
            'code' => 'WEB101',
            'description' => 'Introduction au développement web avec HTML, CSS et JavaScript',
            'coefficient' => 3,
            'professeur_id' => $professeur->id,
        ]);

        $matiere2 = Matiere::create([
            'nom' => 'Base de Données',
            'code' => 'BDD201',
            'description' => 'Conception et gestion des bases de données relationnelles',
            'coefficient' => 4,
            'professeur_id' => $professeur->id,
        ]);

        $matiere3 = Matiere::create([
            'nom' => 'Algorithmique',
            'code' => 'ALGO101',
            'description' => 'Fondamentaux de l\'algorithmique et structures de données',
            'coefficient' => 3,
            'professeur_id' => $professeur->id,
        ]);

        // Créer des notes
        Note::create([
            'etudiant_id' => $etudiant1->id,
            'matiere_id' => $matiere1->id,
            'professeur_id' => $professeur->id,
            'note' => 15.5,
            'type' => 'examen',
            'date_evaluation' => now()->subDays(10),
            'commentaire' => 'Bon travail, continuez ainsi !',
        ]);

        Note::create([
            'etudiant_id' => $etudiant1->id,
            'matiere_id' => $matiere2->id,
            'professeur_id' => $professeur->id,
            'note' => 14.0,
            'type' => 'devoir',
            'date_evaluation' => now()->subDays(5),
        ]);

        Note::create([
            'etudiant_id' => $etudiant1->id,
            'matiere_id' => $matiere3->id,
            'professeur_id' => $professeur->id,
            'note' => 16.5,
            'type' => 'tp',
            'date_evaluation' => now()->subDays(3),
            'commentaire' => 'Excellent travail sur les structures de données',
        ]);

        // Créer l'emploi du temps
        EmploiDuTemps::create([
            'matiere_id' => $matiere1->id,
            'professeur_id' => $professeur->id,
            'jour' => 'lundi',
            'heure_debut' => '08:00',
            'heure_fin' => '10:00',
            'salle' => 'A101',
            'classe' => 'L1 Informatique',
        ]);

        EmploiDuTemps::create([
            'matiere_id' => $matiere2->id,
            'professeur_id' => $professeur->id,
            'jour' => 'mardi',
            'heure_debut' => '10:00',
            'heure_fin' => '12:00',
            'salle' => 'B205',
            'classe' => 'L1 Informatique',
        ]);

        EmploiDuTemps::create([
            'matiere_id' => $matiere3->id,
            'professeur_id' => $professeur->id,
            'jour' => 'mercredi',
            'heure_debut' => '14:00',
            'heure_fin' => '16:00',
            'salle' => 'C102',
            'classe' => 'L1 Informatique',
        ]);

        EmploiDuTemps::create([
            'matiere_id' => $matiere1->id,
            'professeur_id' => $professeur->id,
            'jour' => 'jeudi',
            'heure_debut' => '08:00',
            'heure_fin' => '10:00',
            'salle' => 'A101',
            'classe' => 'L1 Informatique',
        ]);

        EmploiDuTemps::create([
            'matiere_id' => $matiere2->id,
            'professeur_id' => $professeur->id,
            'jour' => 'vendredi',
            'heure_debut' => '10:00',
            'heure_fin' => '12:00',
            'salle' => 'Labo Info',
            'classe' => 'L1 Informatique',
        ]);

        // Créer des alertes
        Alerte::create([
            'titre' => 'Changement de salle - Programmation Web',
            'message' => 'Le cours de Programmation Web de lundi 8h aura lieu en salle B102 au lieu de A101.',
            'type' => 'changement_salle',
            'priorite' => 'haute',
            'auteur_id' => $professeur->id,
            'pour_tous' => true,
        ]);

        Alerte::create([
            'titre' => 'Examen Base de Données',
            'message' => 'Rappel : L\'examen de BDD aura lieu le 25 janvier. N\'oubliez pas vos révisions !',
            'type' => 'general',
            'priorite' => 'moyenne',
            'auteur_id' => $professeur->id,
            'pour_tous' => true,
        ]);

        Alerte::create([
            'titre' => 'Retard de paiement',
            'message' => 'Votre paiement de scolarité du 2ème semestre est en attente. Veuillez régulariser votre situation.',
            'type' => 'paiement',
            'priorite' => 'urgente',
            'auteur_id' => $professeur->id,
            'destinataire_id' => $etudiant1->id,
            'pour_tous' => false,
        ]);

        // Créer des publications
        Publication::create([
            'titre' => 'Bienvenue au semestre 2 !',
            'contenu' => 'Chers étudiants, nous vous souhaitons la bienvenue pour ce nouveau semestre. Les cours reprennent le lundi 20 janvier. Consultez votre emploi du temps pour connaître vos horaires. Nous vous rappelons que la présence est obligatoire et sera vérifiée.',
            'categorie' => 'annonce',
            'est_public' => true,
            'est_epingle' => true,
            'auteur_id' => $professeur->id,
            'date_publication' => now(),
        ]);

        Publication::create([
            'titre' => 'Hackathon PIGIER 2025',
            'contenu' => 'Le groupe PIGIER organise son premier hackathon annuel ! L\'événement aura lieu les 15 et 16 février dans nos locaux. Formez vos équipes de 4 personnes et inscrivez-vous avant le 10 février. De nombreux prix sont à gagner !',
            'categorie' => 'evenement',
            'est_public' => true,
            'est_epingle' => true,
            'auteur_id' => $professeur->id,
            'date_publication' => now()->subDay(),
        ]);

        Publication::create([
            'titre' => 'Nouveaux horaires de la bibliothèque',
            'contenu' => 'La bibliothèque sera désormais ouverte du lundi au vendredi de 8h à 20h et le samedi de 9h à 17h. Profitez de ces nouveaux horaires pour vos révisions.',
            'categorie' => 'information',
            'est_public' => true,
            'est_epingle' => false,
            'auteur_id' => $professeur->id,
            'date_publication' => now()->subDays(2),
        ]);

        Publication::create([
            'titre' => 'Dates des examens de fin de semestre',
            'contenu' => 'Les examens de fin de semestre auront lieu du 10 au 20 mars. Le planning détaillé sera affiché prochainement. Commencez dès maintenant vos révisions !',
            'categorie' => 'urgent',
            'est_public' => true,
            'est_epingle' => true,
            'auteur_id' => $professeur->id,
            'date_publication' => now()->subDays(3),
        ]);

        Publication::create([
            'titre' => 'Conférence sur l\'Intelligence Artificielle',
            'contenu' => 'Une conférence sur l\'IA et ses applications dans l\'entreprise sera donnée par un expert du domaine le vendredi 7 février à 14h en amphi A. Entrée libre pour tous les étudiants.',
            'categorie' => 'evenement',
            'est_public' => true,
            'est_epingle' => false,
            'auteur_id' => $professeur->id,
            'date_publication' => now()->subDays(4),
        ]);

        Publication::create([
            'titre' => 'Rappel : Inscriptions stages',
            'contenu' => 'Les étudiants de L3 doivent déposer leurs conventions de stage avant le 28 février au secrétariat pédagogique. Aucun retard ne sera accepté.',
            'categorie' => 'information',
            'est_public' => true,
            'est_epingle' => false,
            'auteur_id' => $professeur->id,
            'date_publication' => now()->subDays(5),
        ]);
    }
}
