<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livros extends Model
{
    use HasFactory;

    protected $fillable = 
    ['titulo',
    'autor', 
    'editora',
    'ano',
    'edicao',
    'paginas',
    'tipo',
    'id_categoria',
    'descricao',
    'imagem'
];
}
