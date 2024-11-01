<?php

namespace App\Service;

use App\DTO\Auth\UserCreateDTO;
use App\DTO\Auth\UserUpdateDTO;
use App\Http\Resources\Auth\PermissionCollection;
use App\Http\Resources\Auth\RoleCollection;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Repository\User\UserRepository;
use App\Repository\User\UserRepositoryImp;

class UserServiceImp implements UserService
{
    private readonly UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepositoryImp();
    }

    /**
     * @inheritDoc
     */
    public function getAllUsers(): UserCollection
    {
        return new UserCollection($this->userRepository->findAllUsers());
    }

    /**
     * @inheritDoc
     */
    public function getUserById(int $id): UserResource
    {
        return new UserResource($this->userRepository->findUserById($id));
    }

    /**
     * @inheritDoc
     */
    public function createUser(UserCreateDTO $userCreateDTO): UserResource
    {
        return new UserResource($this->userRepository->createUser($userCreateDTO));
    }

    /**
     * @inheritDoc
     */
    public function updateUser(UserUpdateDTO $userUpdateDTO): UserResource
    {
        return new UserResource($this->userRepository->updateUser($userUpdateDTO));
    }

    /**
     * @inheritDoc
     */
    public function deleteUser(int $id): bool
    {
        return $this->userRepository->deleteUser($id);
    }

    /**
     * @inheritDoc
     */
    public function assignRoles(int $userId, array $roles): UserResource
    {
        return new UserResource($this->userRepository->assignRoles($userId, $roles));
    }

    /**
     * @inheritDoc
     */
    public function assignPermissions(int $userId, array $permissions): UserResource
    {
        return new UserResource($this->userRepository->assignPermissions($userId, $permissions));
    }

    /**
     * @inheritDoc
     */
    public function getRoles(): RoleCollection
    {
        return new RoleCollection($this->userRepository->getRoles());
    }

    /**
     * @inheritDoc
     */
    public function getPermissions(): PermissionCollection
    {
        return new PermissionCollection($this->userRepository->getPermissions());
    }
}
