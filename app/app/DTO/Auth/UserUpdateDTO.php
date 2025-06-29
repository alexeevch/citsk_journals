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
    public ?string $first_name = null;
    public ?string $last_name = null;
    public ?string $patronymic = null;
    public ?string $phone = null;
    public ?array $roles = [];
    public ?array $permissions = [];

    protected function rules(): array
    {
        return [
            'id'          => ['required', 'integer'],
            'email'       => ['email'],
            'first_name'  => ['string'],
            'last_name'   => ['string'],
            'patronymic'  => ['string'],
            'post'        => ['string'],
            'phone'       => ['string'],
            'roles'       => ['array'],
            'permissions' => ['array'],
            'password'    => [
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
