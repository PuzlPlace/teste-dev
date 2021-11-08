<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Livro extends Model
{
    use HasFactory;
    protected $table = "livros";
    protected $fillable = ['nome','autor','categoria','codigo','tipo','tamanho'];

    public function user():BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }
}
