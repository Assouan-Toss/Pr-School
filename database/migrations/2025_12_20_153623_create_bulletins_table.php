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
    Schema::create('bulletins', function (Blueprint $table) {
        $table->id();

        $table->foreignId('eleve_id')
              ->constrained('users')
              ->onDelete('cascade');

        $table->string('semestre');
        $table->string('file_path');
        
        $table->foreignId('classe_id')
              ->nullable()
              ->constrained('classes')
              ->nullOnDelete();

        $table->foreignId('publie_par')   // admin
              ->constrained('users')
              ->onDelete('cascade');

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulletins');
    }
};
