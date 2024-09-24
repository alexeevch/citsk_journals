<?php

namespace App\DTO\Auth;

use Illuminate\Validation\Rules\Password;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class UserCreateDTO extends ValidatedDTO
{
    public string $email;
    public string $login;
    public string $password;
    public string $firstName;
    public string $lastName;
    public ?string $patronymic;
    public string $phone;


    protected function rules(): array
    {
        return [
            'email'      => ['required', 'email'],
            'login'      => ['required', 'string'],
            'first_name' => ['required', 'string'],
            'last_name'  => ['required', 'string'],
            'patronymic' => ['string'],
            'post'       => ['required', 'string'],
            'phone'      => ['required', 'string'],
            'password'   => [
                'required', Password::min(8)
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
