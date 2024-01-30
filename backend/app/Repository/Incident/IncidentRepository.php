<?php

namespace App\Repository\Incident;

use App\DTO\Incident\IncidentCreateDTO;
use App\DTO\Incident\IncidentUpdateDTO;
use App\Models\Incident;

class IncidentRepository implements IncidentRepositoryInterface
{

    /**
     * @inheritDoc
     */
    function create(IncidentCreateDTO $incidentCreateDTO): Incident
    {
        $incident = new Incident();
        $incident->attacker = $incidentCreateDTO->attacker;
        $incident->infrastructure = $incidentCreateDTO->infrastructure;
        $incident->type = $incidentCreateDTO->type;
        $incident->status = $incidentCreateDTO->status;
        $incident->description = $incidentCreateDTO->description;
        $incident->detection_time = $incidentCreateDTO->detection_time;
        $incident->group_alert_time = $incidentCreateDTO->group_alert_time;
        $incident->supervisor_alert_time = $incidentCreateDTO->supervisor_alert_time;
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
}
