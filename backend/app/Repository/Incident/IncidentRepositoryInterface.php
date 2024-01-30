<?php

namespace App\Repository\Incident;

use App\DTO\Incident\IncidentCreateDTO;
use App\DTO\Incident\IncidentUpdateDTO;
use App\Models\Attacker;
use App\Models\Incident;
use App\Models\Infrastructure;
use Illuminate\Database\Eloquent\Collection;

interface IncidentRepositoryInterface
{
    /**
     * @param  IncidentCreateDTO  $incidentCreateDTO
     * @param  Attacker           $attacker
     * @param  Infrastructure     $infrastructure
     *
     * @return Incident
     */
    function create(IncidentCreateDTO $incidentCreateDTO, Attacker $attacker, Infrastructure $infrastructure): Incident;

    /**
     * @param  IncidentUpdateDTO  $incidentUpdateDTO
     * @param  Attacker|null  $attacker
     * @param  Infrastructure|null  $infrastructure
     *
     * @return Incident
     */
    function update(
        IncidentUpdateDTO $incidentUpdateDTO,
        ?Attacker $attacker,
        ?Infrastructure $infrastructure
    ): Incident;

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
