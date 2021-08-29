<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Auth\Access\HandlesAuthorization;

class VacancyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */

    public function before(User $user)
    {
        if ($user->rolle == 'admin' ) {
            return true;
        }
    }

    public function viewAny(User $user)
    {
//        if ($user->role == 'worker'){
//            return $user->role == 'worker';
//        }
        return true;

    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Vacancy $vacancy)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
//        if ($user->rolle == 'employer' ) {
//            return true;
//        }
        return $user->role == 'employer';

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Vacancy $vacancy)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Vacancy $vacancy)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Vacancy $vacancy)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Vacancy $vacancy)
    {
        //
    }
}
