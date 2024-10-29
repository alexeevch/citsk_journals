<?php

namespace App\Repository\Auth;

use App\DTO\Role\PermissionUpdateDTO;
use App\DTO\Role\PermissonCreateDTO;
use App\DTO\Role\RoleCreateDTO;
use App\DTO\Role\RoleUpdateDTO;
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
     * @param  RoleCreateDTO  $roleCreateDTO
     *
     * @return Role
     */
    public function createRole(RoleCreateDTO $roleCreateDTO): Role;

    /**
     * @param  int            $id
     * @param  RoleUpdateDTO  $roleUpdateDTO
     *
     * @return Role
     */
    public function updateRole(int $id, RoleUpdateDTO $roleUpdateDTO): Role;

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
     * @param  PermissonCreateDTO  $permissionCreateDTO
     *
     * @return Permission
     */
    public function createPermission(PermissonCreateDTO $permissionCreateDTO): Permission;

    /**
     * @param  int                  $id
     * @param  PermissionUpdateDTO  $permissionUpdateDTO
     *
     * @return Permission
     */
    public function updatePermission(int $id, PermissionUpdateDTO $permissionUpdateDTO): Permission;

    /**
     * @param  int  $id
     *
     * @return int
     */
    public function deletePermission(int $id): int;
}
