<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CabinResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'cabinlevel_id' => $this->cabinlevel_id,
            'capacidad' => $this->capacity,
            'busy' => $this->busy,

        ];

    }
}
