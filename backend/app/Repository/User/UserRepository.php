<?php

namespace App\Repository\User;

use App\DTO\Auth\UserCreateDTO;
use App\DTO\Auth\UserUpdateDTO;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use Illuminate\Database\Eloquent\Collection;

interface UserRepository
{
    /**
     * @param  array|null  $filter
     *
     * @return UserCollection
     */
    public function findAll(?array $filter = null): UserCollection;

    /**
     * @param  int  $id
     *
     * @return UserResource
     */
    public function findById(int $id): UserResource;

    /**
     * @param  UserCreateDTO  $userCreateDTO
     *
     * @return UserResource
     */
    public function create(UserCreateDTO $userCreateDTO): UserResource;

    /**
     * @param  UserUpdateDTO  $userUpdateDTO
     *
     * @return UserResource
     */
    public function update(UserUpdateDTO $userUpdateDTO): UserResource;

    /**
     * @param  mixed  $id
     *
     * @return int
     */
    public function delete(int $id): int;

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
