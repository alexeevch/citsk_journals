<?php

namespace App\DTO\Permission;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class PermissionUpdateDTO extends ValidatedDTO
{
    public int $id;
    public ?string $name = null;
    public ?string $description = null;
    public ?bool $deletable = false;

    protected function rules(): array
    {
        return [
            'id'          => ['required', 'integer'],
            'name'        => ['string'],
            'description' => ['string'],
            'deletable'   => ['boolean'],
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
