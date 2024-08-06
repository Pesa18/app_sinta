<?php

namespace App\Policies;

use App\Models\SirkulasiArsip;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

class SirkulasiArsipPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return Gate::allows('akses-sirkulasi-arsip');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SirkulasiArsip $sirkulasiArsip): bool
    {
        return Gate::allows('akses-sirkulasi-arsip');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Gate::allows('akses-sirkulasi-arsip');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SirkulasiArsip $sirkulasiArsip): bool
    {
        return Gate::allows('akses-sirkulasi-arsip');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SirkulasiArsip $sirkulasiArsip): bool
    {
        return Gate::allows('akses-sirkulasi-arsip');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SirkulasiArsip $sirkulasiArsip): bool
    {
        return Gate::allows('akses-sirkulasi-arsip');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SirkulasiArsip $sirkulasiArsip): bool
    {
        return Gate::allows('akses-sirkulasi-arsip');
    }
}
