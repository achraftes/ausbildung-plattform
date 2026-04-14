<?php
// database/migrations/xxxx_create_cvs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('cvs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('modele')->default('modern'); // modern | klassisch | kreativ
            $table->string('vorname');
            $table->string('nachname');
            $table->string('email');
            $table->string('telefon')->nullable();
            $table->string('adresse')->nullable();
            $table->string('stadt')->nullable();
            $table->string('beruf_titel')->nullable();
            $table->text('profil_text')->nullable();
            $table->text('berufserfahrung')->nullable(); // JSON
            $table->text('ausbildung')->nullable();      // JSON
            $table->text('kenntnisse')->nullable();      // JSON
            $table->text('sprachen')->nullable();        // JSON
            $table->text('hobbys')->nullable();
            $table->string('foto')->nullable();
            $table->integer('ats_score')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('cvs');
    }
};