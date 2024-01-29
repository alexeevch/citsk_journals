<?php

namespace App\Repository\Attacker;

use App\DTO\Attacker\AttackerCreateDTO;
use App\DTO\Attacker\AttackerUpdateDTO;
use App\Models\Attacker;

interface AttackerRepositoryInterface
{
    /**
     * @param  AttackerCreateDTO  $attackerCreateDTO
     *
     * @return Attacker
     */
    function create(AttackerCreateDTO $attackerCreateDTO): Attacker;

    /**
     * @param  AttackerUpdateDTO  $attackerUpdateDTO
     *
     * @return Attacker
     */
    function update(AttackerUpdateDTO $attackerUpdateDTO): Attacker;
}
