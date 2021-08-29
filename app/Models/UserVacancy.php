<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserVacancy extends Model
{
    use HasFactory;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->attributes['user_id'] = Auth::id();
    }

    protected $fillable = [
//        'user_id',
        'vacancy_id'
    ];
}
