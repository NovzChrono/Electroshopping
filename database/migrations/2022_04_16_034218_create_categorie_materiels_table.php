<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategorieMaterielsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorie_materiels', function (Blueprint $table) {
            $table->id();
            $table->string('libelleCatMat');
            $table->string("imageCatMat");
            $table->longText("descriptionCatMat");
            $table->tinyInteger("statutCatMat")->default('0');
            $table->tinyInteger("popularCatMat")->default('0');
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
        Schema::dropIfExists('categorie_materiels');
    }
}
