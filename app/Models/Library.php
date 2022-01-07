<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method paginate(int $int)
 * @method findOrFail($library_id)
 * @property mixed $id
 */
class Library extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo|Author
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * @return BelongsTo|Category
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
