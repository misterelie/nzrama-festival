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
            $table->string('nom_membre', 50);
            $table->string('prenoms', 191);
            $table->string('fonction')->nullable();
            $table->string('telephone', 50)->nullable();
            $table->string('num_whatsapp', 50)->nullable();
            $table->string('email', 191)->nullable()->unique();
            $table->foreignId('commission_id');
            $table->foreignId('categorie_id');
            $table->foreignId('user_id')->nullable();
            $table->string('specicite_fonction_membre')->nullable();
            $table->date('date_creation')->nullable();
            $table->string('code_membre')->nullable();
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
