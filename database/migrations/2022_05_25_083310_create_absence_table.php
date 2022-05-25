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
        Schema::create('absence', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')
                ->constrained('etudiants')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('seance_id')
                ->constrained('seances')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->boolean('is_absent')->default(0);
//          si is_absent == 1 donc l'etudiant est absent
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
        Schema::dropIfExists('absence');
    }
};
