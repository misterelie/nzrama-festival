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
        Schema::create('documentattributions', function (Blueprint $table) {
            $table->id();
            $table->integer('type_document_id')->nullable();
            $table->string('nom_fichier')->nullable();
            $table->integer('attribution_id')->nullable();
            $table->string('libelle_attribution', 191)->nullable();
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
        Schema::dropIfExists('documentattributions');
    }
};
