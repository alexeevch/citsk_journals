<?php

namespace App\Repository\Incident;

use App\DTO\Incident\IncidentCreateDTO;
use App\DTO\Incident\IncidentUpdateDTO;
use App\Models\Incident;
use Illuminate\Database\Eloquent\Collection;

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

    /**
     * @return Collection
     */
    function findAll(): Collection;

    /**
     * @param  int  $id
     *
     * @return Incident
     */
    function findById(int $id): Incident;

    /**
     * @param  int  $id
     *
     * @return bool
     */
    function delete(int $id): bool;
}
