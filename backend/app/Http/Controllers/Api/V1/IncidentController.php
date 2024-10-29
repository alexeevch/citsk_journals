<?php

namespace App\Http\Controllers\Api\V1;

use App\DTO\Incident\IncidentCreateDTO;
use App\DTO\Incident\IncidentUpdateDTO;
use App\Http\Controllers\Controller;
use App\Http\Resources\Incident\IncidentCollection;
use App\Http\Resources\Incident\IncidentResource;
use App\Service\IncidentServiceImp;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Throwable;
use WendellAdriel\ValidatedDTO\Exceptions\CastTargetException;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;

class IncidentController extends Controller
{
    public function __construct(private readonly IncidentServiceImp $incidentService)
    {
    }

    /**
     * @return IncidentCollection
     */
    public function index(): IncidentCollection
    {
        return $this->incidentService->findAll();
    }

    /**
     * @throws MissingCastTypeException
     * @throws Throwable
     * @throws CastTargetException
     * @throws ValidationException
     */
    public function store(Request $request): IncidentResource
    {
        return $this->incidentService->create(IncidentCreateDTO::fromRequest($request));
    }

    /**
     * @param  int  $id
     *
     * @return IncidentResource
     */
    public function show(int $id): IncidentResource
    {
        return $this->incidentService->findById($id);
    }

    /**
     * @param  Request  $request
     * @param  int      $id
     *
     * @return IncidentResource
     * @throws CastTargetException
     * @throws MissingCastTypeException
     * @throws Throwable
     * @throws ValidationException
     */
    public function update(Request $request, int $id): IncidentResource
    {
        $request->request->add(['id' => $id]);

        return $this->incidentService->update(IncidentUpdateDTO::fromRequest($request));
    }

    /**
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy(int $id): Response
    {
        $this->incidentService->delete($id);

        return response()->noContent();
    }
}
