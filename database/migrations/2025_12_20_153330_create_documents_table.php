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
    Schema::create('documents', function (Blueprint $table) {
        $table->id();
        $table->string('titre');
        $table->text('description')->nullable();
        $table->string('file_path');

        $table->enum('visible_pour', ['eleves', 'professeurs', 'tous'])->default('eleves');

        // relations
        $table->foreignId('publie_par')
              ->constrained('users')
              ->onDelete('cascade');

        $table->foreignId('classe_id')
              ->nullable()
              ->constrained()
              ->onDelete('set null');

        $table->foreignId('matiere_id')
              ->nullable()
              ->constrained('matieres')
              ->onDelete('set null');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
