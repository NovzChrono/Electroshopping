<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('nom');
            $table->string('pnom');
            $table->string('email');
            $table->string('tel');
            $table->string('adrss1');
            $table->string('adrss2');
            $table->string('ville');
            $table->string('quartier');
            $table->string('total');
            $table->string('codepin');
            $table->tinyInteger('statut')->default('0');
            $table->string('message')->nullable();
            $table->string('suivie_nb');
            $table->date('date');
            $table->string('domicile')->default('0');
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
        Schema::dropIfExists('commandes');
    }
}
