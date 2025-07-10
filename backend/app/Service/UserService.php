<?php

namespace App\Service;

use App\Constants;
use App\DTO\Auth\UserCreateDTO;
use App\DTO\Auth\UserUpdateDTO;
use App\Http\Resources\Auth\PermissionCollection;
use App\Http\Resources\Auth\RoleCollection;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Repository\User\UserRepository;
use App\Repository\User\UserRepositoryImp;
use Illuminate\Support\Facades\DB;
use Throwable;

class UserService
{
    private readonly UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepositoryImp();
    }


    /**
     * @return UserCollection
     */
    public function getAllUsers(): UserCollection
    {
        return new UserCollection($this->userRepository->findAllUsers());
    }


    /**
     * @param  int  $id
     *
     * @return UserResource
     */
    public function getUserById(int $id): UserResource
    {
        return new UserResource($this->userRepository->findUserById($id));
    }


    /**
     * @param  UserCreateDTO  $userCreateDTO
     *
     * @return UserResource
     * @throws Throwable
     */
    public function createUser(UserCreateDTO $userCreateDTO): UserResource
    {
        return DB::transaction(function () use ($userCreateDTO) {
            $user = $this->userRepository->createUser($userCreateDTO);
            $user->assignRole(Constants::OBSERVER_ROLE);

            return new UserResource($user);
        });
    }


    /**
     * @param  UserUpdateDTO  $userUpdateDTO
     *
     * @return UserResource
     */
    public function updateUser(UserUpdateDTO $userUpdateDTO): UserResource
    {
        return new UserResource($this->userRepository->updateUser($userUpdateDTO));
    }


    /**
     * @param  int  $id
     *
     * @return bool
     */
    public function deleteUser(int $id): bool
    {
        return $this->userRepository->deleteUser($id);
    }


    /**
     * @param  int    $userId
     * @param  array  $roles
     *
     * @return UserResource
     */
    public function assignRoles(int $userId, array $roles): UserResource
    {
        return new UserResource($this->userRepository->assignRoles($userId, $roles));
    }


    /**
     * @param  int    $userId
     * @param  array  $permissions
     *
     * @return UserResource
     */
    public function assignPermissions(int $userId, array $permissions): UserResource
    {
        return new UserResource($this->userRepository->assignPermissions($userId, $permissions));
    }


    /**
     * @return RoleCollection
     */
    public function getRoles(): RoleCollection
    {
        return new RoleCollection($this->userRepository->getRoles());
    }

    /**
     * @return PermissionCollection
     */
    public function getPermissions(): PermissionCollection
    {
        return new PermissionCollection($this->userRepository->getPermissions());
    }
}
