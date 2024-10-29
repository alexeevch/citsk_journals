<?php

namespace App\Repository\Auth;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

interface RoleAndPermissionRepository
{

    /**
     * @return Collection
     */
    public function getAllRoles(): Collection;

    /**
     * @param  array  $params
     *
     * @return Role
     */
    public function createRole(array $params): Role;

    /**
     * @param  int    $id
     * @param  array  $params
     *
     * @return Role
     */
    public function updateRole(int $id, array $params): Role;

    /**
     * @param  int  $id
     *
     * @return int
     */
    public function deleteRole(int $id): int;

    /**
     * @return Collection
     */
    public function getAllPermissions(): Collection;

    /**
     * @param  array  $params
     *
     * @return Permission
     */
    public function createPermission(array $params): Permission;

    /**
     * @param  int    $id
     * @param  array  $params
     *
     * @return Permission
     */
    public function updatePermission(int $id, array $params): Permission;

    /**
     * @param  int  $id
     *
     * @return int
     */
    public function deletePermission(int $id): int;
}
