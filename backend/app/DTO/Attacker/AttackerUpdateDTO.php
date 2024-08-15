<?php

namespace App\DTO\Attacker;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class AttackerUpdateDTO extends ValidatedDTO
{
    public int $id;
    public ?string $ipv4;
    public ?string $description;
    public ?string $country;

    protected function rules(): array
    {
        return [
            'id'          => ['required', 'integer'],
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
