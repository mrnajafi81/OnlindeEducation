<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Test extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function course()
    {
        return $this->lesson->course();
    }


    public function scopeSearch(Builder $query)
    {
        $search = request()->query('search');
        $row = request()->query('row');

        if ($search && $row) {

            switch ($row) {

                case 'user_fullname':
                    $query->where('fullname', 'LIKE', "%$search%");
                    break;

                case 'user_number':
                    $query->where('number', 'LIKE', "%$search%");
                    break;

                case 'group_title':
                    $query->where('groups.title', 'LIKE', "%$search%");
                    break;

                case 'lesson_title':
                    $query->where('lessons.title', 'LIKE', "%$search%");
                    break;

            }


        }

    }

}
