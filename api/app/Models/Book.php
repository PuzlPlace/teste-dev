<?php

namespace App\Models;

use App\Models\Enums\Books\FileType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes, HasCodeGenerator;

    protected $table = 'books';

    protected $fillable = [
        'name',
        'categories_id',
        'author',
        'file_type',
        'size_or_weight',
    ];

    protected $hidden = [
        'id',
        'categories_id',
        'created_at',
        'deleted_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'deleted_at',
        'updated_at',
    ];

    protected $appends = [
        'registration_date',
    ];

    //Mutators & Accessors
    public function getRegistrationDateAttribute(){
        return $this->created_at->format('d/m/Y H:i');
    }

    //Relationships
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }

    //Methods
    public function getFileType(): string
    {
        return match ($this->file_type) {
            FileType::Digital => 'Digital',
            FileType::Physical => 'Físico',
            default => 'N/a',
        };
    }
}
