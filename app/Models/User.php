<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'name',
        'last_name',
        'country',
        'city',
        'phone',
        'role',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->attributes['created_by'] = Auth::id();
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //////
    protected $appends = [
        'token'
    ];

    public function getTokenAttribute()
    {
        return $this->createToken('token-name')->plainTextToken;
    }

    ////


    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    //////

    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }

    public function vacancies()
    {
        return $this->belongsToMany(Vacancy::class, 'user_vacancies', 'user_id', 'vacancy_id');
    }


}
