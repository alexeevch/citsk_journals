<?php

namespace App\DTO\IncidentType;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class IncidentTypeUpdateDTO extends ValidatedDTO
{
    public int $id;
    public ?string $name = null;
    public ?string $description = null;

    protected function rules(): array
    {
        return [
            'id'          => ['required', 'integer'],
            'name'        => ['string'],
            'description' => ['string'],
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
