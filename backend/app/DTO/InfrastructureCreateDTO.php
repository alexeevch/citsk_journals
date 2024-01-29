<?php

namespace App\DTO;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class InfrastructureCreateDTO extends ValidatedDTO
{
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
