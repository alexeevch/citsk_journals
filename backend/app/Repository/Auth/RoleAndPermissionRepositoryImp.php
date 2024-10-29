<?php

namespace App\Repository\Auth;

use App\DTO\Permission\PermissionUpdateDTO;
use App\DTO\Permission\PermissionCreateDTO;
use App\DTO\Role\RoleCreateDTO;
use App\DTO\Role\RoleUpdateDTO;
use App\Models\Permission;
use App\Models\Role;
use App\Constants;
use Illuminate\Database\Eloquent\Collection;

class RoleAndPermissionRepositoryImp implements RoleAndPermissionRepository
{
    /**
     * @return Collection
     */
    public function getAllRoles(): Collection
    {
        return Role::handleSharedCache(fn() => Role::with('permissions')->whereNot('name', '=',
            Constants::ROOT_ROLE)->get());
    }

    /**
     * @inheritDoc
     */
    public function findRoleById(int $id): Role
    {
        return Role::findOrFail($id);
    }


    /**
     * @param  RoleCreateDTO  $roleCreateDTO
     *
     * @return Role
     */
    public function createRole(RoleCreateDTO $roleCreateDTO): Role
    {
        $role = new Role;
        $role->name = $roleCreateDTO->name;
        $role->description = $roleCreateDTO->description;

        if (auth()->user()->hasRole(Constants::ROOT_ROLE)) {
            $role->deletable = false;
        }

        if (isset($roleCreateDTO->permissions)) {
            $role->syncPermissions($roleCreateDTO->permissions);
        }

        $role->save();
        $role->forgetSharedCache();
        $role->permissions;

        return $role;
    }

    /**
     * @param  RoleUpdateDTO  $roleUpdateDTO
     *
     * @return Role
     */
    public function updateRole(RoleUpdateDTO $roleUpdateDTO): Role
    {
        $role = Role::findById($roleUpdateDTO->id);

        $role->forgetSharedCache();

        if (!$role->deletable) {
            $role->permissions;

            return $role;
            // throw new ForbiddenException('Cannot update default role');
        }

        $role->fill((array) $roleUpdateDTO);
        $role->syncPermissions($roleUpdateDTO->permissons);
        $role->save();
        $role->permissions;

        return $role;
    }

    /**
     * @param  mixed  $id
     *
     * @return int
     */
    public function deleteRole($id): int
    {
        $id = (is_array($id)) ? $id : [$id];
        $trulyIds = [];

        foreach (Role::whereIn('id', $id)->get() as $role) {
            if (!$role->deletable) {
                continue;
            }

            $trulyIds[] = $role->id;
        }

        Role::forgetSharedCache();

        return count($trulyIds) ? Role::whereIn('id', $trulyIds)->delete() : 0;
    }

    /**
     * @return Collection
     */
    public function getAllPermissions(): Collection
    {
        return Permission::handleSharedCache(fn() => Permission::select('id', 'name', 'description',
            'deletable')->orderByDesc('id')->get());
    }

    /**
     * @inheritDoc
     */
    public function findPermissionById(int $id): Permission
    {
        return Permission::findOrFail($id);
    }

    /**
     * @param  PermissionCreateDTO  $permissionCreateDTO
     *
     * @return Permission
     */
    public function createPermission(PermissionCreateDTO $permissionCreateDTO): Permission
    {
        $permission = new Permission;
        $permission->deletable = true;
        $permission->fill((array) $permissionCreateDTO);
        $permission->save();
        $permission->forgetSharedCache();

        return $permission;
    }

    /**
     * @param  PermissionUpdateDTO  $permissionUpdateDTO
     *
     * @return Permission
     */
    public function updatePermission(PermissionUpdateDTO $permissionUpdateDTO): Permission
    {
        $permission = Permission::findById($permissionUpdateDTO->id);

        if (!$permission->deletable) {
            if (isset($permissionUpdateDTO->description)) {
                $permission->description = $permissionUpdateDTO->description;
            }
        } else {
            $permission->fill((array) $permissionUpdateDTO);
        }

        $permission->save();
        $permission->forgetSharedCache();

        return $permission;
    }

    /**
     * @param  mixed  $id
     *
     * @return int
     */
    public function deletePermission($id): int
    {
        $id = is_array($id) ? $id : [$id];
        $trulyIds = [];

        foreach (Permission::whereIn('id', $id)->get() as $permission) {
            if (!$permission->deletable) {
                continue;
            }

            $trulyIds[] = $permission->id;
        }

        Permission::forgetSharedCache();

        return count($trulyIds) ? Permission::whereIn('id', $trulyIds)->delete() : 0;
    }
}
