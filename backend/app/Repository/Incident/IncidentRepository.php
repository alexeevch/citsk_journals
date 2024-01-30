<?php

namespace App\Repository\Incident;

use App\DTO\Incident\IncidentCreateDTO;
use App\DTO\Incident\IncidentUpdateDTO;
use App\Models\Attacker;
use App\Models\Incident;
use App\Models\Infrastructure;
use Illuminate\Database\Eloquent\Collection;

class IncidentRepository implements IncidentRepositoryInterface
{

    /**
     * @inheritDoc
     */
    function create(IncidentCreateDTO $incidentCreateDTO, Attacker $attacker, Infrastructure $infrastructure): Incident
    {
        $incident = new Incident();
        $incident->description = $incidentCreateDTO->description;
        $incident->detection_time = $incidentCreateDTO->detection_time;
        $incident->group_alert_time = $incidentCreateDTO->group_alert_time;
        $incident->supervisor_alert_time = $incidentCreateDTO->supervisor_alert_time;
        $incident->type = $incidentCreateDTO->type;
        $incident->status = $incidentCreateDTO->status;

        $incident->attacker()->associate($attacker);
        $incident->infrastructure()->associate($infrastructure);

        $incident->save();

        return $incident;
    }

    /**
     * @inheritDoc
     */
    function update(IncidentUpdateDTO $incidentUpdateDTO): Incident
    {
        $incident = Incident::findOrFail($incidentUpdateDTO->id);

        foreach ($incidentUpdateDTO->toArray() as $key => $value) {
            $incident->$key = $value;
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
