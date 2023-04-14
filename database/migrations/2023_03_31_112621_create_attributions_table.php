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
        Schema::create('attributions', function (Blueprint $table) {
            $table->id();
            $table->string('nom_attribution', 50);
            $table->foreignId('commission_id')->nullable();;
            $table->text('description_attribution')->nullable();
            $table->foreignId('user_id')->nullable();;
            $table->string('code_attribution')->nullable();
            $table->integer('etat')->default(1);
            $table->date('date_creation')->nullable();
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
        Schema::dropIfExists('attributions');
    }
};
