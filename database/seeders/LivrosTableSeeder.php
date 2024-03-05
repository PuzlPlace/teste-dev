<?php

namespace Database\Seeders;

use App\Models\Livro;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LivrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++) {
            Livro::create([
                'nome' => $faker->sentence(3),
                'autor' => $faker->name,
                'categoria' => $faker->randomElement(['Ficção', 'Não Ficção', 'Mistério', 'Romance']),
                'codigo' => $faker->unique()->ean13,
                'tipo' => $faker->randomElement(['físico', 'digital']),
                'tamanho' => $faker->randomFloat(2, 1, 1000),
            ]);
        }
    }
}
