<?php

namespace App\DTO\IncidentType;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class IncidentTypeCreateDTO extends ValidatedDTO
{
    public string $name;
    public ?string $description;

    protected function rules(): array
    {
        return [
            'name'        => ['required', 'string'],
            'description' => ['string']
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
