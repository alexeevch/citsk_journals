<?php

namespace App\Service;

use App\Constants;
use App\DTO\Auth\UserCreateDTO;
use App\DTO\Auth\UserUpdateDTO;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserServiceImp implements UserService
{

    /**
     * @inheritDoc
     */
    public function getUserById(int $id): UserResource
    {
        return new UserResource(User::findOrFail($id));
    }

    /**
     * @inheritDoc
     */
    public function getAllUsers(): UserCollection
    {
        return new UserCollection(User::all());
    }

    /**
     * @inheritDoc
     */
    public function createUser(UserCreateDTO $userCreateDTO): UserResource
    {
        $user = new User();
        $user->email = $userCreateDTO->email;
        $user->login = $userCreateDTO->login;
        $user->password = $userCreateDTO->password;
        $user->first_name = $userCreateDTO->first_name;
        $user->last_name = $userCreateDTO->last_name;
        $user->patronymic = $userCreateDTO->patronymic;
        $user->post = $userCreateDTO->post;
        $user->phone = $userCreateDTO->phone;
        $user->save();

        return new UserResource($user);
    }

    /**
     * @inheritDoc
     */
    public function updateUser(UserUpdateDTO $userUpdateDTO): UserResource
    {
        $user = User::findOrFail($userUpdateDTO->id);
        $user->update($userUpdateDTO);
        $user->save();

        return new UserResource($user);
    }

    /**
     * @inheritDoc
     */
    public function deleteUser(int $id): bool
    {
        return (bool) User::findOrFail($id)->delete();
    }

    /**
     * @inheritDoc
     */
    public function assignRoles(int $userId, array $roles): UserResource
    {
        User::forgetSharedCache();

        return new UserResource(User::findOrFail($userId)->syncRoles($roles));
    }

    /**
     * @inheritDoc
     */
    public function assignPermissions(int $userId, array $permissions): UserResource
    {
        User::forgetSharedCache();

        return new UserResource(User::findOrFail($userId)->syncPermissions($permissions));
    }

    /**
     * @inheritDoc
     */
    public function getRoles(): Collection
    {
        return Role::handleSharedCache(fn() => Role::select(['id', 'name', 'description'])->where('name', '!=',
            Constants::ROOT_ROLE)->get());
    }

    /**
     * @inheritDoc
     */
    public function getPermissions(): Collection
    {
        return Permission::handleSharedCache(fn() => Permission::select(['id', 'name', 'description'])->get());
    }
}
