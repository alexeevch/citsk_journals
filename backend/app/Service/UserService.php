<?php

namespace App\Service;

use App\DTO\Auth\UserCreateDTO;
use App\DTO\Auth\UserUpdateDTO;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use Illuminate\Database\Eloquent\Collection;

interface UserService
{
    /**
     * @param  int  $id
     *
     * @return UserResource
     */
    public function getUserById(int $id): UserResource;

    /**
     * @return UserCollection
     */
    public function getAllUsers(): UserCollection;

    /**
     * @param  UserCreateDTO  $userCreateDTO
     *
     * @return UserResource
     */
    public function createUser(UserCreateDTO $userCreateDTO): UserResource;

    /**
     * @param  UserUpdateDTO  $userUpdateDTO
     *
     * @return UserResource
     */
    public function updateUser(UserUpdateDTO $userUpdateDTO): UserResource;

    /**
     * @param  int  $id
     *
     * @return bool
     */
    public function deleteUser(int $id): bool;

    /**
     * @param  int    $userId
     * @param  array  $roles
     *
     * @return UserResource
     */
    public function assignRoles(int $userId, array $roles): UserResource;

    /**
     * @param  int    $userId
     * @param  array  $permissions
     *
     * @return UserResource
     */
    public function assignPermissions(int $userId, array $permissions): UserResource;

    /**
     * @return Collection
     */
    public function getRoles(): Collection;

    /**
     * @return Collection
     */
    public function getPermissions(): Collection;
}
