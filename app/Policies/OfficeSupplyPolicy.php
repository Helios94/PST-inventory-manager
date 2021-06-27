<?php

namespace App\Policies;

use App\Models\OfficeSupply;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class OfficeSupplyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OfficeSupply  $officeSupply
     * @return mixed
     */
    public function view(User $user, OfficeSupply $officeSupply)
    {
        return $user->isAdmin()
            ? true
            : ($user->id === $officeSupply->user_id
                ? Response::allow()
                : Response::deny('You do not own this Office Supply Item.'));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OfficeSupply  $officeSupply
     * @return mixed
     */
    public function update(User $user, OfficeSupply $officeSupply)
    {
        return $user->isAdmin()
            ? true
            : ($user->id === $officeSupply->user_id
                ? Response::allow()
                : Response::deny('You do not own this Office Supply Item.'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OfficeSupply  $officeSupply
     * @return mixed
     */
    public function delete(User $user, OfficeSupply $officeSupply)
    {
        return $user->isAdmin()
            ? true
            : ($user->id === $officeSupply->user_id
                ? Response::allow()
                : Response::deny('You do not own this Office Supply Item.'));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OfficeSupply  $officeSupply
     * @return mixed
     */
    public function restore(User $user, OfficeSupply $officeSupply)
    {
        return $user->isAdmin()
            ? true
            : ($user->id === $officeSupply->user_id
                ? Response::allow()
                : Response::deny('You do not own this Office Supply Item.'));
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OfficeSupply  $officeSupply
     * @return mixed
     */
    public function forceDelete(User $user, OfficeSupply $officeSupply)
    {
        return $user->isAdmin()
            ? true
            : ($user->id === $officeSupply->user_id
                ? Response::allow()
                : Response::deny('You do not own this Office Supply Item.'));
    }
}
