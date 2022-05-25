<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seances', function (Blueprint $table) {
            $table->id();
            $table->string('matiere');
            $table->string('ref_salle');
            $table->dateTime('date_debut');
            $table->dateTime('date_fin');
            $table->time('heure_debut');
            $table->string('jours_de_semaine');
            $table->boolean('active')->default(0);
            $table->boolean('seance_passe')->default(0);
            $table->foreignId('filiere_id')
                ->constrained('filieres')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seances');
    }
};
