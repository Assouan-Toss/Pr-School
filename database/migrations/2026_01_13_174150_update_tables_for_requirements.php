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
        // 1. Add 'is_suspended' to users table
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_suspended')->default(false)->after('role');
        });

        // 2. Add 'type' to documents table
        Schema::table('documents', function (Blueprint $table) {
            // types: 'cours', 'roman', 'livre', 'autre'
            $table->enum('type', ['cours', 'roman', 'livre', 'autre'])->default('cours')->after('description');
        });

        // 3. Update annonces table
        Schema::table('annonces', function (Blueprint $table) {
            // targeting: 'tous', 'professeurs', 'eleves', 'classe'
            $table->enum('visible_pour', ['tous', 'professeurs', 'eleves', 'classe'])->default('tous')->after('contenu');
            $table->foreignId('classe_id')->nullable()->constrained()->onDelete('cascade')->after('visible_pour');
        });

        // 4. Create document_downloads table
        Schema::create('document_downloads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('document_id')->constrained()->onDelete('cascade');
            $table->timestamp('downloaded_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_downloads');

        Schema::table('annonces', function (Blueprint $table) {
            $table->dropForeign(['classe_id']);
            $table->dropColumn(['classe_id', 'visible_pour']);
        });

        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn('type');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_suspended');
        });
    }
};
