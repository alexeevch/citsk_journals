<?php

namespace App\Http\Controllers\Api\v1;

use App\DTO\Role\RoleCreateDTO;
use App\DTO\Role\RoleUpdateDTO;
use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\RoleCollection;
use App\Http\Resources\Auth\RoleResource;
use App\Service\RoleAndPermissionService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Throwable;
use WendellAdriel\ValidatedDTO\Exceptions\CastTargetException;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;

class RoleController extends Controller
{
    public function __construct(private readonly RoleAndPermissionService $roleAndPermissionService)
    {
    }

    /**
     * @return RoleCollection
     */
    public function index(): RoleCollection
    {
        return $this->roleAndPermissionService->findRoleAll();
    }

    /**
     * @throws MissingCastTypeException
     * @throws Throwable
     * @throws CastTargetException
     * @throws ValidationException
     */
    public function store(Request $request): RoleResource
    {
        return $this->roleAndPermissionService->createRole(RoleCreateDto::fromRequest($request));
    }

    /**
     * @param  int  $id
     *
     * @return RoleResource
     */
    public function show(int $id): RoleResource
    {
        return $this->roleAndPermissionService->findRoleById($id);
    }

    /**
     * @param  Request  $request
     * @param  int      $id
     *
     * @return RoleResource
     * @throws CastTargetException
     * @throws MissingCastTypeException
     * @throws ValidationException
     */
    public function update(Request $request, int $id): RoleResource
    {
        $request->request->add(['id' => $id]);

        return $this->roleAndPermissionService->updateRole(RoleUpdateDTO::fromRequest($request));
    }

    /**
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy(int $id): Response
    {
        $this->roleAndPermissionService->deleteRole($id);

        return response()->noContent();
    }
}
