<?php

namespace App\Repository\Incident;

use App\DTO\Incident\IncidentCreateDTO;
use App\DTO\Incident\IncidentUpdateDTO;
use App\Models\Attacker;
use App\Models\Incident;
use App\Models\Infrastructure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class IncidentRepositoryImp implements IncidentRepository
{

    /**
     * @inheritDoc
     */
    function create(IncidentCreateDTO $incidentCreateDTO, Attacker $attacker, Infrastructure $infrastructure): Incident
    {
        $incident = new Incident();
        $incident->description = $incidentCreateDTO->description;
        $incident->detection_at = $incidentCreateDTO->detection_at;
        $incident->group_notified_at = $incidentCreateDTO->group_notified_at;
        $incident->supervisor_notified_at = $incidentCreateDTO->supervisor_notified_at;
        $incident->type = $incidentCreateDTO->type;
        $incident->status = $incidentCreateDTO->status;

        $incident->attacker()->associate($attacker);
        $incident->infrastructure()->associate($infrastructure);

        $incident->save();

        return $incident;
    }

    /**
     * @param  IncidentUpdateDTO  $incidentUpdateDTO
     * @param  Attacker           $attacker
     * @param  Infrastructure     $infrastructure
     *
     * @inheritDoc
     */
    function update(
        IncidentUpdateDTO $incidentUpdateDTO,
        ?Attacker $attacker,
        ?Infrastructure $infrastructure
    ): Incident {
        $incident = Incident::findOrFail($incidentUpdateDTO->id);

        foreach ($incidentUpdateDTO->toArray() as $key => $value) {
            if (str_contains($key, "attacker") || str_contains($key, "infrastructure")) {
                continue;
            }

            $incident->$key = $value;

            if ($attacker) {
                $incident->attacker()->associate($attacker);
            }

            if ($infrastructure) {
                $incident->infrastructure()->associate(($infrastructure));
            }
        }

        $incident->save();

        return $incident;
    }

    /**
     * @inheritDoc
     */
    function findAll(): Collection
    {
        return Incident::all();
    }

    /**
     * @inheritDoc
     */
    public function findAllPaginated(
        int $perPage = 15,
        int $page = 1,
        ?array $filters = null,
        ?string $sortField = 'id',
        ?string $sortDirection = 'asc'
    ): LengthAwarePaginator {
        $query = Incident::query()->with([
            'attacker',
            'infrastructure',
            'type',
            'status'
        ]);

        if ($filters) {
            foreach ($filters as $field => $value) {
                if ($value !== null) {
                    $query->where($field, $value);
                }
            }
        }

        $query->orderBy($sortField, $sortDirection);

        return $query->paginate($perPage, ['*'], 'page', $page);
    }

    /**
     * @inheritDoc
     */
    function findById(int $id): Incident
    {
        return Incident::findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    function delete(int $id): bool
    {
        return (bool) Incident::findOrFail($id)->delete();
    }
}
