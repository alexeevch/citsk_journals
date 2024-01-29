<?php

namespace App\DTO\Infrastructure;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class InfrastructureUpdateDTO extends ValidatedDTO
{
    public int $id;
    public ?string $ipv4 = null;
    public ?string $name = null;
    public ?string $owner = null;

    protected function rules(): array
    {
        return [
            'id'    => ['required', 'integer'],
            'ipv4'  => ['ipv4'],
            'name'  => ['string'],
            'owner' => ['string'],
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
