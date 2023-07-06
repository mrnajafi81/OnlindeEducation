<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Group extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function startedAt(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => new Carbon($value)
        );
    }

    protected function endedAt(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => new Carbon($value)
        );
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
