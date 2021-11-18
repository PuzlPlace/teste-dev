<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo', 190)->nullable();
            $table->string('autor', 190)->nullable();
            $table->string('editora',50)->nullable();
            $table->integer('ano')->nullable();
            $table->string('edicao' ,20)->nullable();
            $table->Integer('tipo')->nullable();
            $table->Integer('paginas')->nullable();
            $table->text('descricao')->nullable();
            $table->string('imagem')->nullable();
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
        Schema::dropIfExists('livros');
    }
}
