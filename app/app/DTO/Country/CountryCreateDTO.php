<?php

namespace App\DTO\Country;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class CountryCreateDTO extends ValidatedDTO
{
    public string $name;
    public string $code;

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'code' => ['required', 'string', 'size:20'],
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
