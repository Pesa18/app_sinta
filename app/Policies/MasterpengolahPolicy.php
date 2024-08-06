<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Masterpengolah;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

class MasterpengolahPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return Gate::allows('akses-pengaturan');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Masterpengolah $masterpengolah): bool
    {
        return Gate::allows('akses-pengaturan');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Gate::allows('akses-pengaturan');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Masterpengolah $masterpengolah): bool
    {
        return Gate::allows('akses-pengaturan');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Masterpengolah $masterpengolah): bool
    {
        return Gate::allows('akses-pengaturan');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Masterpengolah $masterpengolah): bool
    {
        return Gate::allows('akses-pengaturan');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Masterpengolah $masterpengolah): bool
    {
        return Gate::allows('akses-pengaturan');
    }
}
