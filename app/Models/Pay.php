<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Pay extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
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

                case 'course_title':
                    $query->where('courses.title', 'LIKE', "%$search%");
                    break;

                case 'group_title':
                    $query->where('groups.title', 'LIKE', "%$search%");
                    break;

                case 'ref_id':
                    $query->where('ref_id', 'LIKE', "%$search%");
                    break;

            }


        }

    }


}
