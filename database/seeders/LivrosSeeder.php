<?php

namespace Database\Seeders;

use Faker\Core\Number;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class LivrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('livros')->insert([
            'titulo' => 'LIVRO-'. Number::randomNumber(1),
            'autor' => 'Thiago-Dev'.Str::random(4),
            'editora' => 'Evo-Sis',
            'edicao' => Number::randomNumber(4),
            'tipo' =>  '1',
            'id_categoria' =>  '1',
            'ano' =>Number::randomNumber(4),
            'paginas' => Number::randomNumber(2),
            'descricao' => ' é simplesmente uma simulação de texto da indústria tipográfica e de impressos,',
        
         
        ]);
    }
}
