<?php

namespace App\Repository\Infrastructure;

use App\DTO\Infrastructure\InfrastructureCreateDTO;
use App\DTO\Infrastructure\InfrastructureUpdateDTO;
use App\Models\Infrastructure;

class InfrastructureRepository implements InfrastructureRepositoryInterface
{

    /**
     * @inheritDoc
     */
    function create(InfrastructureCreateDTO $infrastructureCreateDTO): Infrastructure
    {
        $infrastructure = new Infrastructure();
        $infrastructure->ipv4 = $infrastructureCreateDTO->ipv4;
        $infrastructure->name = $infrastructureCreateDTO->name;
        $infrastructure->owner = $infrastructureCreateDTO->owner;
        $infrastructure->save();

        return $infrastructure;
    }

    /**
     * @inheritDoc
     */
    function update(InfrastructureUpdateDTO $infrastructureUpdateDTO): Infrastructure
    {
        $infrastructure = Infrastructure::findOrFail($infrastructureUpdateDTO->id);

        foreach ($infrastructureUpdateDTO->toArray() as $key => $value) {
            $infrastructure->$key = $value;
        }

        $infrastructure->save();

        return $infrastructure;
    }
}
