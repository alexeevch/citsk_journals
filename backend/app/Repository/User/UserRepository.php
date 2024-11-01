<?php

namespace App\Repository\User;

use App\DTO\Auth\UserCreateDTO;
use App\DTO\Auth\UserUpdateDTO;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepository
{
    /**
     * @param  array|null  $filter
     *
     * @return Collection
     */
    public function findAllUsers(?array $filter = null): Collection;

    /**
     * @param  int  $id
     *
     * @return User
     */
    public function findUserById(int $id): User;

    /**
     * @param  UserCreateDTO  $userCreateDTO
     *
     * @return User
     */
    public function createUser(UserCreateDTO $userCreateDTO): User;

    /**
     * @param  UserUpdateDTO  $userUpdateDTO
     *
     * @return User
     */
    public function updateUser(UserUpdateDTO $userUpdateDTO): User;

    /**
     * @param  mixed  $id
     *
     * @return bool
     */
    public function deleteUser(int $id): bool;

    /**
     * @param  int    $userId
     * @param  array  $roles
     *
     * @return User
     */
    public function assignRoles(int $userId, array $roles): User;

    /**
     * @param  int    $userId
     * @param  array  $permissions
     *
     * @return User
     */
    public function assignPermissions(int $userId, array $permissions): User;

    /**
     * @return Collection
     */
    public function getRoles(): Collection;

    /**
     * @return Collection
     */
    public function getPermissions(): Collection;

}
