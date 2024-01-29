<?php

namespace App\DTO\Attacker;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class AttackerUpdateDTO extends ValidatedDTO
{
    public int $id;
    public ?string $ipv4 = null;
    public ?string $description = null;
    public ?string $country = null;

    protected function rules(): array
    {
        return [
            'id'          => ['require', 'integer'],
            'ipv4'        => ['ipv4'],
            'description' => ['string'],
            'country'     => ['string']

        ];
    }

    protected function casts(): array
    {
        return [];
    }

    protected function defaults(): array
    {
        return [];
    }
}
