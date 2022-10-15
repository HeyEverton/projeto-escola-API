<?php

namespace App\Policies;

use App\Models\Professor;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfessorPolicy
{
    use HandlesAuthorization;



    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        return $user->role->name === 'ADMINISTRADOR' ||
        $user->role->name === 'PROFESSOR' ||
        $user->role->name === 'ALUNO' ||
        $user->role->name === 'SECRETARIA';
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->role->name === 'ADMINISTRADOR' ||
        $user->role->name === 'PROFESSOR' ||
        $user->role->name === 'SECRETARIA';                

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        return $user->role->name === 'ADMINISTRADOR' ||
               $user->role->name === 'PROFESSOR';
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        return $user->role->name === 'ADMINISTRADOR';
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    // public function restore(User $user, Professor $professor)
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  *
    //  * @param  \App\Models\User  $user
    //  * @param  \App\Models\Professor  $professor
    //  * @return \Illuminate\Auth\Access\Response|bool
    //  */
    // public function forceDelete(User $user, Professor $professor)
    // {
    //     //
    // }
}
