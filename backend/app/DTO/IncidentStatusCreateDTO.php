<?php

namespace App\DTO;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class IncidentStatusCreateDTO extends ValidatedDTO
{
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
