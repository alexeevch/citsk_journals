<?php

namespace App\DTO\Incident;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class IncidentUpdateDTO extends ValidatedDTO
{
    protected function rules(): array
    {
        return [];
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
