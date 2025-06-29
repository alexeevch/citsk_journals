<?php

namespace App\DTO\Auth;

use Illuminate\Validation\Rules\Password;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class UserCreateDTO extends ValidatedDTO
{
    public string $email;
    public string $password;
    public string $first_name;
    public string $last_name;
    public ?string $patronymic;
    public string $post;
    public string $phone;
    public ?bool $is_blocked;
    public ?array $roles;
    public ?array $permissions;


    protected function rules(): array
    {
        return [
            'email'       => ['required', 'email'],
            'first_name'  => ['required', 'string'],
            'last_name'   => ['required', 'string'],
            'patronymic'  => ['string'],
            'post'        => ['required', 'string'],
            'phone'       => ['string'],
            'roles'       => ['array'],
            'permissions' => ['array'],
            'password'    => [
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
