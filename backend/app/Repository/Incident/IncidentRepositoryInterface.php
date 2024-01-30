<?php

namespace App\Repository\Incident;

use App\DTO\Incident\IncidentCreateDTO;
use App\DTO\Incident\IncidentUpdateDTO;
use App\Models\Incident;

interface IncidentRepositoryInterface
{
    /**
     * @param  IncidentCreateDTO  $incidentCreateDTO
     *
     * @return Incident
     */
    function create(IncidentCreateDTO $incidentCreateDTO): Incident;

    /**
     * @param  IncidentUpdateDTO  $incidentUpdateDTO
     *
     * @return Incident
     */
    function update(IncidentUpdateDTO $incidentUpdateDTO): Incident;
}
