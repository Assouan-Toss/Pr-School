<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
Schema::create('documents', function (Blueprint $table) {
    $table->id();
    $table->string('titre');
    $table->text('description')->nullable();

    // Chemin du fichier
    $table->string('file_path');

    // Visibilité
    $table->enum('visible_pour', ['eleves', 'professeurs', 'tous'])
          ->default('tous');

    // Relations
    $table->foreignId('publie_par')
          ->constrained('users')
          ->onDelete('cascade');

    $table->foreignId('classe_id')->nullable()->constrained()->nullOnDelete();
    $table->foreignId('matiere_id')->nullable()->constrained()->nullOnDelete();

    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
