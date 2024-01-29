<?php

namespace App\DTO;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class AttackerCreateDTO extends ValidatedDTO
{
    public string $ipv4;
    public string $description;
    public string $country;

    protected function rules(): array
    {
        return [
            'ipv4'        => ['required', 'ipv4'],
            'description' => ['required', 'string'],
            'country'     => ['required', 'string'],
        ];
    }

    protected function defaults(): array
    {
        return [];
    }

    protected function casts(): array
    {
        return [

        ];
    }
}
