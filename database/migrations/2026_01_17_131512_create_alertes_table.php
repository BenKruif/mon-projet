<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alertes', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('message');
            $table->enum('type', ['changement_salle', 'disponibilite', 'paiement', 'general'])->default('general');
            $table->enum('priorite', ['basse', 'moyenne', 'haute', 'urgente'])->default('moyenne');
            $table->foreignId('auteur_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('destinataire_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->boolean('pour_tous')->default(false);
            $table->boolean('lu')->default(false);
            $table->datetime('date_expiration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alertes');
    }
};
