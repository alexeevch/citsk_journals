<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class PaginatedCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'data'       => $this->collection,
            'pagination' => $this->getPagination()
        ];
    }

    protected function getPagination(): array
    {
        return [
            'total'        => $this->resource->total(),
            'count'        => $this->resource->count(),
            'per_page'     => $this->resource->perPage(),
            'current_page' => $this->resource->currentPage(),
            'total_pages'  => $this->resource->lastPage(),
            'has_more'     => $this->resource->currentPage() < $this->resource->lastPage(),
        ];
    }

    public function toResponse($request): JsonResponse
    {
        return new JsonResponse($this->toArray($request));
    }
}
