<?php

namespace App\Policies;

use App\Models\Organization;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrganizationPolicy
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
        if ($user->rolle == 'admin') {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Organization $organization
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Organization $organization)
    {
        return $user->id == $organization->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if ($user->rolle == 'employer') {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Organization $organization
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Organization $organization)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Organization $organization
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Organization $organization)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Organization $organization
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Organization $organization)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Organization $organization
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Organization $organization)
    {
        //
    }
}
