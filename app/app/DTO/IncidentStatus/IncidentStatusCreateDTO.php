<?php

namespace App\DTO\IncidentStatus;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class IncidentStatusCreateDTO extends ValidatedDTO
{
    public string $name;

    protected function rules(): array
    {
        return [
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
