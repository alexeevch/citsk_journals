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

interface RoleAndPermissionService
{
    public function findRoleAll(): RoleCollection;

    public function createRole(RoleCreateDTO $roleCreateDTO): RoleResource;

    public function findRoleById(int $id): RoleResource;

    public function updateRole(RoleUpdateDTO $roleUpdateDTO): RoleResource;

    public function deleteRole(int $id): bool;

    public function findPermissionAll(): PermissionCollection;

    public function createPermission(PermissionCreateDTO $permissionCreateDTO): PermissionResource;

    public function findPermissionById(int $id): PermissionResource;

    public function updatePermission(PermissionUpdateDTO $permissionUpdateDTO): PermissionResource;

    public function deletePermission(int $id): bool;
}
