<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterielsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materiels', function (Blueprint $table) {
            $table->id();
            $table->string("nom_mat");
            $table->string("tag");
            $table->foreignId('marque_id')->constrained();
            $table->foreignId('vendeur_id')->constrained();
            $table->longText("description_mat");
            $table->longText("gdescription_mat");
            $table->integer('prixnormal_mat');
            $table->integer('prixreduit_mat');
            $table->integer('qte_mat');
            $table->integer('impot_mat');
            $table->tinyInteger("statut_mat")->default('0');
            $table->tinyInteger("popular_mat")->default('0');
            $table->string("image_mat");
            $table->string("image2_mat");
            $table->string("image3_mat");
            $table->foreignId('categorie_materiel_id') -> constrained();
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
        Schema::dropIfExists('materiels');
    }
}
