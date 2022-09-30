<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TripsCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return ['data' => $this->collection];
    }
}
