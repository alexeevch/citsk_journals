<?php

namespace App\DTO\Infrastructure;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class InfrastructureCreateDTO extends ValidatedDTO
{
    public string $ipv4;
    public string $name;
    public int $owner_id;

    protected function rules(): array
    {
        return [
            'ipv4'     => ['required', 'ipv4'],
            'name'     => ['required', 'string'],
            'owner_id' => ['required', 'integer', 'exists:owners,id'],
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
