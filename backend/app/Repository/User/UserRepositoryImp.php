<?php

namespace App\Repository\User;

use App\DTO\Auth\UserCreateDTO;
use App\DTO\Auth\UserUpdateDTO;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Service\UserService;
use App\Service\UserServiceImp;
use Illuminate\Database\Eloquent\Collection;

class UserRepositoryImp implements UserRepository
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserServiceImp();
    }

    /**
     * @inheritDoc
     */
    public function findAll(?array $filter = null): UserCollection
    {
        return $this->userService->getAllUsers();
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): UserResource
    {
        return $this->userService->getUserById($id);
    }

    /**
     * @inheritDoc
     */
    public function create(UserCreateDTO $userCreateDTO): UserResource
    {
        return $this->userService->createUser($userCreateDTO);
    }

    /**
     * @inheritDoc
     */
    public function update(UserUpdateDTO $userUpdateDTO): UserResource
    {
        return $this->userService->updateUser($userUpdateDTO);
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): int
    {
        return $this->userService->deleteUser($id);
    }

    /**
     * @inheritDoc
     */
    public function assignRoles(int $userId, array $roles): UserResource
    {
        return $this->userService->assignRoles($userId, $roles);
    }

    /**
     * @inheritDoc
     */
    public function assignPermissions(int $userId, array $permissions): UserResource
    {
        return $this->userService->assignPermissions($userId, $permissions);
    }

    /**
     * @inheritDoc
     */
    public function getRoles(): Collection
    {
        return $this->userService->getRoles();
    }

    /**
     * @inheritDoc
     */
    public function getPermissions(): Collection
    {
        return $this->userService->getPermissions();
    }
}
