<?php

namespace App\Http\Controllers\Api\v1;

use App\DTO\Incident\IncidentCreateDTO;
use App\DTO\Incident\IncidentUpdateDTO;
use App\Http\Controllers\Controller;
use App\Http\Resources\Incident\IncidentCollection;
use App\Http\Resources\Incident\IncidentResource;
use App\Service\IncidentService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Throwable;
use WendellAdriel\ValidatedDTO\Exceptions\CastTargetException;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;

class IncidentController extends Controller
{
    public function __construct(private readonly IncidentService $incidentService)
    {
    }

    /**
     * @param  Request  $request
     *
     * @return IncidentCollection
     */
    public function index(Request $request): IncidentCollection
    {
        $validated = $request->validate([
            'per_page'  => 'sometimes|integer|min:1|max:100',
            'page'      => 'sometimes|integer|min:1',
            'sort_by'   => 'sometimes|string|in:id,detection_at,group_notified_at,supervisor_notified_at',
            'sort_dir'  => 'sometimes|string|in:asc,desc',
            'status_id' => 'sometimes|integer',
            'type_id'   => 'sometimes|integer',
        ]);

        return $this->incidentService->findAll(
            $validated['per_page'] ?? 40,
            $validated['page'] ?? 1,
            [
                'status_id' => $validated['status_id'] ?? null,
                'type_id'   => $validated['type_id'] ?? null,
            ],
            $validated['sort_by'] ?? 'id',
            $validated['sort_dir'] ?? 'desc'
        );
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
