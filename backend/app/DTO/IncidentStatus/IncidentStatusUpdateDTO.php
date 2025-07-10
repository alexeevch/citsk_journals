<?php

namespace App\DTO\IncidentStatus;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class IncidentStatusUpdateDTO extends ValidatedDTO
{
    public int $id;
    public ?string $name = null;

    protected function rules(): array
    {
        return [
            'id'   => ['required', 'integer'],
            'name' => ['string'],
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
