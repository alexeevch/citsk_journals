<?php

namespace App\Service;

use App\DTO\Incident\IncidentCreateDTO;
use App\DTO\Incident\IncidentUpdateDTO;
use App\Http\Resources\Incident\IncidentCollection;
use App\Http\Resources\Incident\IncidentResource;
use App\Repository\Attacker\AttackerRepository;
use App\Repository\Attacker\AttackerRepositoryImp;
use App\Repository\Incident\IncidentRepository;
use App\Repository\Incident\IncidentRepositoryImp;
use App\Repository\Infrastructure\InfrastructureRepository;
use App\Repository\Infrastructure\InfrastructureRepositoryImp;
use Illuminate\Support\Facades\DB;
use Throwable;

class IncidentService
{
    private readonly IncidentRepository $incidentRepository;
    private readonly AttackerRepository $attackerRepository;
    private readonly InfrastructureRepository $infrastructureRepository;

    public function __construct()
    {
        $this->incidentRepository = new IncidentRepositoryImp();
        $this->attackerRepository = new AttackerRepositoryImp();
        $this->infrastructureRepository = new InfrastructureRepositoryImp();
    }

    /**
     * @param  IncidentCreateDTO  $incidentCreateDTO
     *
     * @return IncidentResource
     * @throws Throwable
     */
    function create(IncidentCreateDTO $incidentCreateDTO): IncidentResource
    {
        return DB::transaction(function () use ($incidentCreateDTO) {
            $attacker = $this->attackerRepository->create($incidentCreateDTO->attacker);
            $infrastructure = $this->infrastructureRepository->create($incidentCreateDTO->infrastructure);
            $incident = $this->incidentRepository->create($incidentCreateDTO, $attacker, $infrastructure);

            return new IncidentResource($incident);
        });
    }

    /**
     * @param  int          $perPage
     * @param  int          $page
     * @param  array|null   $filters
     * @param  string|null  $sortField
     * @param  string|null  $sortDirection
     *
     * @return IncidentCollection
     */
    public function findAll(
        int $perPage = 15,
        int $page = 1,
        ?array $filters = null,
        ?string $sortField = 'id',
        ?string $sortDirection = 'desс'
    ): IncidentCollection {
        return new IncidentCollection(
            $this->incidentRepository->findAllPaginated(
                $perPage,
                $page,
                $filters,
                $sortField,
                $sortDirection
            )
        );
    }

    /**
     * @param  int  $id
     *
     * @return IncidentResource
     */
    function findById(int $id): IncidentResource
    {
        return new IncidentResource($this->incidentRepository->findById($id));
    }

    /**
     * @param  IncidentUpdateDTO  $incidentUpdateDTO
     *
     * @return IncidentResource
     * @throws Throwable
     */
    function update(
        IncidentUpdateDTO $incidentUpdateDTO
    ): IncidentResource {
        return DB::transaction(function () use ($incidentUpdateDTO) {
            $attacker = null;
            $infrastructure = null;

            if ($incidentUpdateDTO->attacker) {
                $attacker = $this->attackerRepository->update($incidentUpdateDTO->attacker);
            }

            if ($incidentUpdateDTO->infrastructure) {
                $infrastructure = $this->infrastructureRepository->update($incidentUpdateDTO->infrastructure);
            }

            $incident = $this->incidentRepository->update($incidentUpdateDTO, $attacker, $infrastructure);

            return new IncidentResource($incident);
        });
    }

    /**
     * @param  int  $id
     *
     * @return bool
     */
    function delete(int $id): bool
    {
        return $this->incidentRepository->delete($id);
    }
}
