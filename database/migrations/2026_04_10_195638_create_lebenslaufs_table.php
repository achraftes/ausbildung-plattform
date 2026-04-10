<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('lebenslaeufe', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('vollname');
        $table->text('faehigkeiten')->nullable();
        $table->text('erfahrung')->nullable();
        $table->text('ausbildung')->nullable();
        $table->string('sprache')->default('DE');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lebenslaufs');
    }
};
