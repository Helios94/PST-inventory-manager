<?php

namespace App\Policies;

use App\Models\Food;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class FoodPolicy
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
//        return $user->isAdmin();
        return Auth::check();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Food  $food
     * @return mixed
     */
    public function view(User $user, Food $food)
    {
        return $user->isAdmin()
                    ? true
                    : ($user->id === $food->user_id
                    ? Response::allow()
                    : Response::deny('You do not own this Food Item.'));
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
     * @param  \App\Models\Food  $food
     * @return mixed
     */
    public function update(User $user, Food $food)
    {
        return $user->isAdmin()
            ? true
            : ($user->id === $food->user_id
                ? Response::allow()
                : Response::deny('You do not own this Food Item.'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Food  $food
     * @return mixed
     */
    public function delete(User $user, Food $food)
    {
        return $user->isAdmin()
            ? true
            : ($user->id === $food->user_id
                ? Response::allow()
                : Response::deny('You do not own this Food Item.'));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Food  $food
     * @return mixed
     */
    public function restore(User $user, Food $food)
    {
        return $user->isAdmin()
            ? true
            : ($user->id === $food->user_id
                ? Response::allow()
                : Response::deny('You do not own this Food Item.'));
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Food  $food
     * @return mixed
     */
    public function forceDelete(User $user, Food $food)
    {
        return $user->isAdmin()
            ? true
            : ($user->id === $food->user_id
                ? Response::allow()
                : Response::deny('You do not own this Food Item.'));
    }
}
