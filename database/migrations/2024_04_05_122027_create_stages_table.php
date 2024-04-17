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
        Schema::create('stages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('offre_id')->constrained()->onDelete('cascade');
            $table->string('fiche_confirmation')->nullable();
            $table->string('fiche_evaluation')->nullable();
            $table->string('rapport')->nullable();
            $table->string('attestation')->nullable();
            $table->integer('statut')->default(-1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stages');
    }
};
