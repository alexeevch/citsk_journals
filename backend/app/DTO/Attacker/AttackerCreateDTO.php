<?php

namespace App\DTO\Attacker;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class AttackerCreateDTO extends ValidatedDTO
{
    public string $ipv4;
    public string $description;
    public string $country;

    protected function rules(): array
    {
        return [
            'ipv4'        => ['required', 'ipv4'],
            'description' => ['string'],
            'country'     => ['required', 'string'],
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
