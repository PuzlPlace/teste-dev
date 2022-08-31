<?php

namespace App\Models;

use Illuminate\Support\Str;

trait HasUuidGenerator
{
    protected static function bootHasUuidGenerator(): void
    {
        static::creating(function($query) {
            $query->code = (string)Str::uuid();
        });
    }
}
