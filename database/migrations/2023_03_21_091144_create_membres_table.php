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
        Schema::create('membres', function (Blueprint $table) {
            $table->id();
            $table->string('nom_membre', 50)->nullable();
            $table->string('prenoms_membre', 191)->nullable();
            $table->string('fonction_membre', 191)->nullable();
            $table->string('numero_telephone', 50)->nullable();
            $table->string('numero_whatsapp', 50)->nullable();
            $table->foreignId('commission_id')->nullable();
            $table->string('email', 191)->nullable()->unique();
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
        Schema::dropIfExists('membres');
    }
};
