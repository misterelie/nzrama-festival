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
        Schema::create('taches', function (Blueprint $table) {
            $table->id();
            $table->string('nom_tache');
            $table->foreignId('attribution_id')->nullable();
            $table->longText('description')->nullable();
            $table->string('code_tache', 150)->nullable();
            $table->foreignId('user_id')->nullable();
            $table->integer('etat')->default(1);
            $table->dateTime('date_creation')->nullable();
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
        Schema::dropIfExists('taches');
    }
};
