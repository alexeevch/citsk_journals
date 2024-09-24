<?php

namespace App\DTO\Auth;

use Illuminate\Validation\Rules\Password;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class UserUpdateDTO extends ValidatedDTO
{
    public int $id;
    public ?string $email = null;
    public ?string $login = null;
    public ?string $password = null;
    public ?string $firstName = null;
    public ?string $lastName = null;
    public ?string $patronymic = null;
    public ?string $phone = null;

    protected function rules(): array
    {
        return [
            'id'         => ['required', 'integer'],
            'email'      => ['email'],
            'login'      => ['string'],
            'first_name' => ['string'],
            'last_name'  => ['string'],
            'patronymic' => ['string'],
            'post'       => ['string'],
            'phone'      => ['string'],
            'password'   => [
                Password::min(8)
                        ->mixedCase()
                        ->letters()
                        ->numbers()
                        ->symbols()
                        ->uncompromised(),
            ],
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
