<?php

namespace App\Repository\Infrastructure;

use App\DTO\Infrastructure\InfrastructureCreateDTO;
use App\DTO\Infrastructure\InfrastructureUpdateDTO;
use App\Models\Infrastructure;

interface InfrastructureRepository
{
    /**
     * @param  InfrastructureCreateDTO  $infrastructureCreateDTO
     *
     * @return Infrastructure
     */
    function create(InfrastructureCreateDTO $infrastructureCreateDTO): Infrastructure;

    /**
     * @param  InfrastructureUpdateDTO  $infrastructureUpdateDTO
     *
     * @return Infrastructure
     */
    function update(InfrastructureUpdateDTO $infrastructureUpdateDTO): Infrastructure;
}
