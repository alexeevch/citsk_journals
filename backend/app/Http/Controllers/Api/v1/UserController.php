<?php

namespace App\Http\Controllers\Api\v1;

use App\DTO\Auth\UserCreateDTO;
use App\DTO\Auth\UserUpdateDTO;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Service\UserService;
use App\Service\UserServiceImp;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use WendellAdriel\ValidatedDTO\Exceptions\CastTargetException;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;

class UserController extends Controller
{
    private readonly UserService $userService;

    public function __construct()
    {
        $this->userService = new UserServiceImp();
    }

    /**
     * @return UserCollection
     */
    public function index(): UserCollection
    {
        return $this->userService->getAllUsers();
    }

    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     * @throws ValidationException
     */
    public function store(Request $request): UserResource
    {
        return $this->userService->createUser(UserCreateDTO::fromRequest($request));
    }

    /**
     * @param $id
     *
     * @return UserResource
     */
    public function show($id): UserResource
    {
        return $this->userService->getUserById($id);
    }

    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     * @throws ValidationException
     */
    public function update(Request $request): UserResource
    {
        return $this->userService->updateUser(UserUpdateDTO::fromRequest($request));
    }

    /**
     * @param $id
     *
     * @return bool
     */
    public function destroy($id): bool
    {
        return $this->userService->deleteUser($id);
    }
}
