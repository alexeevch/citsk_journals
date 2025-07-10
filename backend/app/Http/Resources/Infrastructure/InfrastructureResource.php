<?php

namespace App\Http\Resources\Infrastructure;

use App\Http\Resources\Owner\OwnerResource;
use App\Models\Infrastructure;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Infrastructure
 */
class InfrastructureResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'ipv4'  => $this->ipv4,
            'name'  => $this->name,
            'owner' => new OwnerResource($this->owner),
        ];
    }
}
