<?php

namespace App\DTO\Role;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class RoleCreateDTO extends ValidatedDTO
{
    public string $name;
    public string $description;
    public bool $deletable = false;
    public array $permissions = [];

    protected function rules(): array
    {
        return [
            'name'        => ['required', 'string'],
            'description' => ['string'],
            'deletable'   => ['required', 'boolean'],
            'permissions' => ['array'],
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
