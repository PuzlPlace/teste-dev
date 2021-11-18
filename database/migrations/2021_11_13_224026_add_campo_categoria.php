<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCampoCategoria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Livros', function (Blueprint $table) {
           $table->unsignedInteger('id_categoria');
           $table->foreign('id_categoria')->references('id')->on('livros_categorias');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Livros', function (Blueprint $table) {
           $table->dropForeign('id_categoria');
        });
    }
}
