<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('advices', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('categorie'); // lebenslauf, anschreiben, interview, gehalt, deutschland
            $table->text('contenu');
            $table->string('image')->nullable();
            $table->string('temps_lecture')->default('3 Min');
            $table->boolean('is_top')->default(false); // Tipp der Woche
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('advices');
    }
};
