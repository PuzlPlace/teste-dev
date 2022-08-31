<?php

namespace App\Models;

use Illuminate\Support\Str;

trait HasCodeGenerator
{
    protected static function bootHasCodeGenerator(): void
    {
        static::creating(function($query) {
            $query->code = (string)Str::uuid();
        });
    }
}
