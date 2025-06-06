<?php

namespace App\Repository\Auth;

use App\DTO\Permission\PermissionCreateDTO;
use App\DTO\Permission\PermissionUpdateDTO;
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
     * @param  int  $id
     *
     * @return Role
     */
    public function findRoleById(int $id): Role;

    /**
     * @param  RoleCreateDTO  $roleCreateDTO
     *
     * @return Role
     */
    public function createRole(RoleCreateDTO $roleCreateDTO): Role;

    /**
     * @param  RoleUpdateDTO  $roleUpdateDTO
     *
     * @return Role
     */
    public function updateRole(RoleUpdateDTO $roleUpdateDTO): Role;

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
     * @param  int  $id
     *
     * @return Permission
     */
    public function findPermissionById(int $id): Permission;

    /**
     * @param  PermissionCreateDTO  $permissionCreateDTO
     *
     * @return Permission
     */
    public function createPermission(PermissionCreateDTO $permissionCreateDTO): Permission;

    /**
     * @param  PermissionUpdateDTO  $permissionUpdateDTO
     *
     * @return Permission
     */
    public function updatePermission(PermissionUpdateDTO $permissionUpdateDTO): Permission;

    /**
     * @param  int  $id
     *
     * @return int
     */
    public function deletePermission(int $id): int;
}
