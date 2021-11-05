<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            $table -> text("name") -> comment('Name');
            $table -> text("author") -> comment('Author');
            $table -> integer("category") -> comment('Category');
            $table -> string('code')->unique()->comment('Code');
            $table -> integer('type')->comment('Type');
            $table -> string('length')->comment('Length');

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
        Schema::dropIfExists('books');
    }
}
