<?php

namespace App\Policies;

use App\Models\Aluno;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AlunoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    // public function viewAny(User $user)
    // {
    //     //
    // }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        return $user->role->name === 'ADMINISTRADOR' ||
            $user->role->name === 'ALUNO' ||
            $user->role->name === 'PROFESSOR' ||
            $user->role->name === 'SECRETARIA';
    }
    // public function showAluno(User $user, Aluno $aluno)
    // {
    //     // return $user->role === 'Admin';
    // }


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
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        return $user->role->name === 'ADMINISTRADOR' ||
        $user->role->name === 'PROFESSOR' ||
        $user->role->name === 'SECRETARIA';
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        return $user->role->name === 'ADMINISTRADOR' ||
        $user->role->name === 'PROFESSOR' ||
        $user->role->name === 'SECRETARIA';
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Aluno $aluno)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Aluno $aluno)
    {
        //
    }
}
