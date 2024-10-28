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
    
        $level =  match($this->cabinlevel_id){
            1 => 'a'
            2 => 'b'
            3 -> 'c'
        };

        


        return [
            "name" => $this ->name,
            "level" => $level,
           // "amount_of_souls" => $this ->capacity,
        ]
    }
}
