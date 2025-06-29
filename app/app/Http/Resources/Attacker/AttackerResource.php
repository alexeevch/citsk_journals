<?php

namespace App\Http\Resources\Attacker;

use App\Models\Attacker;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Attacker
 */
class AttackerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'ipv4'        => $this->ipv4,
            'description' => $this->description,
            'country'     => $this->country,
        ];
    }
}
