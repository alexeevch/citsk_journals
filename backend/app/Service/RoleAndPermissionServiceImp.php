<?php

namespace App\Service;

use App\DTO\Role\PermissionUpdateDTO;
use App\DTO\Role\PermissonCreateDTO;
use App\DTO\Role\RoleCreateDTO;
use App\DTO\Role\RoleUpdateDTO;
use App\Http\Resources\Auth\PermissionCollection;
use App\Http\Resources\Auth\PermissionResource;
use App\Http\Resources\Auth\RoleCollection;
use App\Http\Resources\Auth\RoleResource;
use App\Repository\Auth\RoleAndPermissionRepository;

class RoleAndPermissionServiceImp implements RoleAndPermissionService
{
    public function __construct(private readonly RoleAndPermissionRepository $roleAndPermissionRepository)
    {
    }

    public function findRoleAll(): RoleCollection
    {
        return new RoleCollection($this->roleAndPermissionRepository->getAllRoles());
    }

    public function createRole(RoleCreateDTO $roleCreateDTO): RoleResource
    {
        return new RoleResource($this->roleAndPermissionRepository->createRole($roleCreateDTO));
    }

    public function findRoleById(int $id): RoleResource
    {
        return new RoleResource($this->findRoleById($id));
    }

    public function updateRole(RoleUpdateDTO $roleUpdateDTO): RoleResource
    {
        return new RoleResource($this->roleAndPermissionRepository->updateRole($roleUpdateDTO));
    }

    public function deleteRole(int $id): bool
    {
        return $this->roleAndPermissionRepository->deleteRole($id);
    }

    public function findPermissionAll(): PermissionCollection
    {
        return new PermissionCollection($this->roleAndPermissionRepository->getAllPermissions());
    }

    public function createPermission(PermissonCreateDTO $permissionCreateDTO): PermissionResource
    {
        return new PermissionResource($this->roleAndPermissionRepository->createPermission($permissionCreateDTO));
    }

    public function findPermissionById(int $id): PermissionResource
    {
        return new PermissionResource($this->findPermissionById($id));
    }

    public function updatePermission(PermissionUpdateDTO $permissionUpdateDTO): PermissionResource
    {
        return new PermissionResource($this->roleAndPermissionRepository->updatePermission($permissionUpdateDTO));
    }

    public function deletePermission(int $id): bool
    {
        return $this->roleAndPermissionRepository->deletePermission($id);
    }
}
