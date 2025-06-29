<?php

namespace App\Http\Resources\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin User
 */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'first_name'  => $this->first_name,
            'last_name'   => $this->last_name,
            'patronymic'  => $this->patronymic,
            'full_name'   => $this->getFullNameAttribute(),
            'post'        => $this->post,
            'email'       => $this->email,
            'phone'       => $this->phone,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
            'roles'       => $this->roles,
            'permissions' => $this->getAllPermissions(),
            'is_blocked'  => $this->is_blocked,
        ];
    }
}
