<?php

namespace App\DTO\Attacker;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class AttackerCreateDTO extends ValidatedDTO
{
    public string $ipv4;
    public ?string $description;
    public ?array $country;

    protected function rules(): array
    {
        return [
            'ipv4'        => ['required', 'ipv4'],
            'country_id'  => ['required', 'integer', 'exists:countries, id'],
            'description' => ['nullable', 'string'],
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
