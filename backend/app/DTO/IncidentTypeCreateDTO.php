<?php

namespace App\DTO;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class IncidentTypeCreateDTO extends ValidatedDTO
{
    protected function rules(): array
    {
        return [
            'name'        => ['required', 'string'],
            'description' => ['required', 'string']
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
