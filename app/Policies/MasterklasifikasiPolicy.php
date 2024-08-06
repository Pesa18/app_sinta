<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Masterklasifikasi;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

class MasterklasifikasiPolicy
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
    public function view(User $user, Masterklasifikasi $masterklasifikasi): bool
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
    public function update(User $user, Masterklasifikasi $masterklasifikasi): bool
    {
        return Gate::allows('akses-pengaturan');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Masterklasifikasi $masterklasifikasi): bool
    {
        return Gate::allows('akses-pengaturan');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Masterklasifikasi $masterklasifikasi): bool
    {
        return Gate::allows('akses-pengaturan');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Masterklasifikasi $masterklasifikasi): bool
    {
        return Gate::allows('akses-pengaturan');
    }
}
