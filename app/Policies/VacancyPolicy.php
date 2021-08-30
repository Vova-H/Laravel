<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class VacancyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */

    public function before(User $user)
    {
        if ($user->role == 'admin') {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Vacancy $vacancy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Vacancy $vacancy)
    {
        if ($user->role == 'employer') {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->role == 'employer';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Vacancy $vacancy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Vacancy $vacancy)
    {
        return $user->role == 'employer';
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Vacancy $vacancy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Vacancy $vacancy)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Vacancy $vacancy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Vacancy $vacancy)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Vacancy $vacancy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Vacancy $vacancy)
    {
        //
    }

    public function book(User $user)
    {
        return $user->role == 'user';
    }

    public function unBook()
    {
        if (Auth::id() == user_id)
            return true;
    }

    public function reject(User $user)
    {
        return $user->role == 'employer';
    }
}
