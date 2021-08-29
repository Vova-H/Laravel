<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Vacancy extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'name',
        'amount_workers',
        'created_by',
        'salary'
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function users(){
        return $this->belongsToMany(User::class, 'user_vacancies', 'vacancy_id','user_id');
    }
}
