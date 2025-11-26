<?php

namespace App\Policies;

use App\Models\Inscricao;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class InscricaoPolicy
{
    public function create(User $user): bool
    {
        return $user->curriculo_aprovado === true;
    }

    public function view(User $user, Inscricao $inscricao): bool{
        return $user->id === $inscricao->user_id || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Inscricao $inscricao): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Inscricao $inscricao): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Inscricao $inscricao): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Inscricao $inscricao): bool
    {
        return false;
    }
}
