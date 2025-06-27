<?php

namespace App\Service;

use App\DTO\Permission\PermissionCreateDTO;
use App\DTO\Permission\PermissionUpdateDTO;
use App\DTO\Role\RoleCreateDTO;
use App\DTO\Role\RoleUpdateDTO;
use App\Http\Resources\Auth\PermissionCollection;
use App\Http\Resources\Auth\PermissionResource;
use App\Http\Resources\Auth\RoleCollection;
use App\Http\Resources\Auth\RoleResource;
use App\Repository\Auth\RoleAndPermissionRepositoryImp;

class RoleAndPermissionService
{
    public function __construct(private readonly RoleAndPermissionRepositoryImp $roleAndPermissionRepository)
    {
    }

    /**
     * @return RoleCollection
     */
    public function findRoleAll(): RoleCollection
    {
        return new RoleCollection($this->roleAndPermissionRepository->getAllRoles());
    }

    /**
     * @param  RoleCreateDTO  $roleCreateDTO
     *
     * @return RoleResource
     */
    public function createRole(RoleCreateDTO $roleCreateDTO): RoleResource
    {
        return new RoleResource($this->roleAndPermissionRepository->createRole($roleCreateDTO));
    }

    /**
     * @param  int  $id
     *
     * @return RoleResource
     */
    public function findRoleById(int $id): RoleResource
    {
        return new RoleResource($this->roleAndPermissionRepository->findRoleById($id));
    }

    /**
     * @param  RoleUpdateDTO  $roleUpdateDTO
     *
     * @return RoleResource
     */
    public function updateRole(RoleUpdateDTO $roleUpdateDTO): RoleResource
    {
        return new RoleResource($this->roleAndPermissionRepository->updateRole($roleUpdateDTO));
    }

    /**
     * @param  int  $id
     *
     * @return bool
     */
    public function deleteRole(int $id): bool
    {
        return $this->roleAndPermissionRepository->deleteRole($id);
    }

    /**
     * @return PermissionCollection
     */
    public function findPermissionAll(): PermissionCollection
    {
        return new PermissionCollection($this->roleAndPermissionRepository->getAllPermissions());
    }

    /**
     * @param  PermissionCreateDTO  $permissionCreateDTO
     *
     * @return PermissionResource
     */
    public function createPermission(PermissionCreateDTO $permissionCreateDTO): PermissionResource
    {
        return new PermissionResource($this->roleAndPermissionRepository->createPermission($permissionCreateDTO));
    }

    /**
     * @param  int  $id
     *
     * @return PermissionResource
     */
    public function findPermissionById(int $id): PermissionResource
    {
        return new PermissionResource($this->roleAndPermissionRepository->findPermissionById($id));
    }

    /**
     * @param  PermissionUpdateDTO  $permissionUpdateDTO
     *
     * @return PermissionResource
     */
    public function updatePermission(PermissionUpdateDTO $permissionUpdateDTO): PermissionResource
    {
        return new PermissionResource($this->roleAndPermissionRepository->updatePermission($permissionUpdateDTO));
    }

    /**
     * @param  int  $id
     *
     * @return bool
     */
    public function deletePermission(int $id): bool
    {
        return $this->roleAndPermissionRepository->deletePermission($id);
    }
}
