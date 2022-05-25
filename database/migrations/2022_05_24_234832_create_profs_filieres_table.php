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
        Schema::create('profs_filieres', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('filiere_id')
                ->constrained('filieres')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('prof_id')
                ->constrained('profs')
                ->onUpdate('cascade')
                ->onDelete('cascade');
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profs_filieres');
    }
};
