<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Organization extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'name',
        'country',
        'city'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function vacancies()
    {
        return $this->hasMany(Vacancy::class);
    }
}
