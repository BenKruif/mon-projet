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
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('contenu');
            $table->string('image')->nullable();
            $table->enum('categorie', ['annonce', 'evenement', 'information', 'urgent'])->default('information');
            $table->boolean('est_public')->default(true);
            $table->boolean('est_epingle')->default(false);
            $table->foreignId('auteur_id')->constrained('users')->onDelete('cascade');
            $table->datetime('date_publication')->nullable();
            $table->datetime('date_expiration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
