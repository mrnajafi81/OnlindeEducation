<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'number',
        'password',
        'role',
        'number_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'number_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function pays(): HasMany
    {
        return $this->hasMany(Pay::class);
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class)->withPivot('group_id', 'pay_id')->withTimestamps();
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'course_user', 'user_id', 'group_id');
    }

    public function tests(): HasMany
    {
        return $this->hasMany(Test::class);
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

            }


        }

    }


}
