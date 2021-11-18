<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivrosCategorias extends Model
{
    use HasFactory;

    protected $fillable = ['categoria'];
}
