<?php

namespace App\DTO\Permission;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class PermissionCreateDTO extends ValidatedDTO
{
    public string $name;
    public string $description;
    public bool $deletable = false;

    protected function rules(): array
    {
        return [
            'name'        => ['required', 'string'],
            'description' => ['string'],
            'deletable'   => ['required', 'boolean'],
        ];
    }

    protected function casts(): array
    {
        return [];
    }

    protected function defaults(): array
    {
        return [];
    }
}
