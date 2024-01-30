<?php

namespace App\Service;

use App\DTO\Incident\IncidentCreateDTO;
use App\DTO\Incident\IncidentUpdateDTO;
use App\Http\Resources\Incident\IncidentCollection;
use App\Http\Resources\Incident\IncidentResource;
use App\Models\Attacker;
use App\Models\Infrastructure;

interface IncidentServiceInterface
{
    /**
     * @param  IncidentCreateDTO  $incidentCreateDTO
     *
     * @return IncidentResource
     */
    function create(IncidentCreateDTO $incidentCreateDTO): IncidentResource;

    /**
     * @return IncidentCollection
     */
    function findAll(): IncidentCollection;

    /**
     * @param  int  $id
     *
     * @return IncidentResource
     */
    function findById(int $id): IncidentResource;

    /**
     * @param  IncidentUpdateDTO  $incidentUpdateDTO
     *
     * @return IncidentResource
     */
    function update(
        IncidentUpdateDTO $incidentUpdateDTO,
        Attacker $attacker,
        Infrastructure $infrastructure
    ): IncidentResource;

    /**
     * @param  int  $id
     *
     * @return bool
     */
    function delete(int $id): bool;
}
