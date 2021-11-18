<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class InsertUserSistema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $email = 'teste@livros.com';
        $password = '12345678';

      DB::table('users')->insert([
        'email'=> $email,
        'name'=> 'Administrador EVO-SIS',
      
        'password'=> bcrypt($password)
      ]);
  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $email = 'teste@livros.com';
        DB::delete(' DELETE FROM users WHERE email =?',$email);
    }
}
