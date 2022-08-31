<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $categories = [
                'Fantasia',
                'Ficção científica',
                'Distopia',
                'Ação e aventura',
                'Ficção Policial',
                'Horror',
                'Thriller e Suspense',
                'Ficção histórica',
                'Romance',
                'Ficção Feminina',
                'LGBTQ+',
                'Ficção Contemporânea',
                'Realismo mágico',
                'Graphic Novel',
                'Conto',
                'Young adult – Jovem adulto',
                'New adult – Novo Adulto' ,
                'Infantil',
            ];

            foreach ($categories as $category){
                Category::query()->firstOrCreate(['name' => $category], ['name' => $category]);
            }

        }catch (\Exception $exception){
            print_r(__FUNCTION__ . PHP_EOL);
            print_r($exception->getMessage() . PHP_EOL);
        }
    }
}
