<?php

namespace App\Repository\Attacker;

use App\DTO\Attacker\AttackerCreateDTO;
use App\DTO\Attacker\AttackerUpdateDTO;
use App\Models\Attacker;

class AttackerRepository implements AttackerRepositoryInterface
{

    /**
     * @inheritDoc
     */
    function create(AttackerCreateDTO $attackerCreateDTO): Attacker
    {
        $attacker = new Attacker();
        $attacker->ipv4 = $attackerCreateDTO->ipv4;
        $attacker->description = $attackerCreateDTO->description;
        $attacker->country = $attackerCreateDTO->country;
        $attacker->save();

        return $attacker;
    }

    /**
     * @inheritDoc
     */
    function update(AttackerUpdateDTO $attackerUpdateDTO): Attacker
    {
        $attacker = Attacker::findOrFail($attackerUpdateDTO->id);

        foreach ($attackerUpdateDTO->toArray() as $key => $value) {
            $attacker->$key = $value;
        }

        $attacker->save();

        return $attacker;
    }
}
