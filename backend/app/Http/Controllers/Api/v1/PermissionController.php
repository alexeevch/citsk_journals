<?php

namespace App\Http\Controllers\Api\v1;

use App\DTO\Permission\PermissionCreateDTO;
use App\DTO\Role\PermissionUpdateDTO;
use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\PermissionCollection;
use App\Http\Resources\Auth\PermissionResource;
use App\Service\RoleAndPermissionServiceImp;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Throwable;
use WendellAdriel\ValidatedDTO\Exceptions\CastTargetException;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;

class PermissionController extends Controller
{
    public function __construct(private readonly RoleAndPermissionServiceImp $roleAndPermissionService)
    {
    }

    /**
     * @return PermissionCollection
     */
    public function index(): PermissionCollection
    {
        return $this->roleAndPermissionService->findPermissionAll();
    }

    /**
     * @throws MissingCastTypeException
     * @throws Throwable
     * @throws CastTargetException
     * @throws ValidationException
     */
    public function store(Request $request): PermissionResource
    {
        return $this->roleAndPermissionService->createPermission(PermissionCreateDto::fromRequest($request));
    }

    /**
     * @param  int  $id
     *
     * @return PermissionResource
     */
    public function show(int $id): PermissionResource
    {
        return $this->roleAndPermissionService->findPermissionById($id);
    }

    /**
     * @param  Request  $request
     * @param  int      $id
     *
     * @return PermissionResource
     * @throws CastTargetException
     * @throws MissingCastTypeException
     * @throws ValidationException
     */
    public function update(Request $request, int $id): PermissionResource
    {
        $request->request->add(['id' => $id]);

        return $this->roleAndPermissionService->updatePermission(PermissionUpdateDTO::fromRequest($request));
    }

    /**
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy(int $id): Response
    {
        $this->roleAndPermissionService->deletePermission($id);

        return response()->noContent();
    }
}
