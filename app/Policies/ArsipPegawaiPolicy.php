<?php

namespace App\Policies;

use App\Models\ArsipPegawai;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

class ArsipPegawaiPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return Gate::allows('akses-arsip-pegawai');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ArsipPegawai $arsipPegawai): bool
    {
        return Gate::allows('akses-arsip-pegawai');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Gate::allows('akses-arsip-pegawai');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ArsipPegawai $arsipPegawai): bool
    {
        return Gate::allows('akses-arsip-pegawai');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ArsipPegawai $arsipPegawai): bool
    {
        return Gate::allows('akses-arsip-pegawai');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ArsipPegawai $arsipPegawai): bool
    {
        return Gate::allows('akses-arsip-pegawai');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ArsipPegawai $arsipPegawai): bool
    {
        return Gate::allows('akses-arsip-pegawai');
    }
}
