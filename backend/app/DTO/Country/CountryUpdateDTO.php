<?php

namespace App\DTO\Country;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class CountryUpdateDTO extends ValidatedDTO
{
    public int $id;
    public ?string $name = null;
    public ?string $code = null;

    protected function rules(): array
    {
        return [
            'id'   => ['required', 'integer'],
            'name' => ['string'],
            'code' => ['string'],
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
