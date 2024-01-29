<?php

namespace App\DTO\Infrastructure;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class InfrastructureCreateDTO extends ValidatedDTO
{
    public string $ipv4;
    public string $name;
    public string $owner;

    protected function rules(): array
    {
        return [
            'ipv4' => ['required', 'ipv4'],
            'name' => ['required', 'string'],
        ];
    }

    protected function defaults(): array
    {
        return [];
    }

    protected function casts(): array
    {
        return [];
    }
}
