<?php

namespace App\Service;

use App\DTO\Incident\IncidentCreateDTO;
use App\DTO\Incident\IncidentUpdateDTO;
use App\Http\Resources\Incident\IncidentCollection;
use App\Http\Resources\Incident\IncidentResource;
use App\Repository\Attacker\AttackerRepositoryImp;
use App\Repository\Incident\IncidentRepositoryImp;
use App\Repository\Infrastructure\InfrastructureRepositoryImp;
use Illuminate\Support\Facades\DB;
use Throwable;

class IncidentService implements IncidentService
{
    public function __construct(
        private readonly IncidentRepositoryImp $incidentRepository,
        private readonly AttackerRepositoryImp $attackerRepository,
        private readonly InfrastructureRepositoryImp $infrastructureRepository,
    ) {
    }

    /**
     * @inheritDoc
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
     * @inheritDoc
     */
    function findAll(): IncidentCollection
    {
        return new IncidentCollection($this->incidentRepository->findAll());
    }

    /**
     * @inheritDoc
     */
    function findById(int $id): IncidentResource
    {
        return new IncidentResource($this->incidentRepository->findById($id));
    }

    /**
     * @inheritDoc
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
     * @inheritDoc
     */
    function delete(int $id): bool
    {
        return $this->incidentRepository->delete($id);
    }
}
