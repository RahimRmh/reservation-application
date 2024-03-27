<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\resturant as ResturantResource;


class place extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return  [
            'Name Of Place' => $this->name,
            'Resturants' => ResturantResource::collection($this->resturants)
                ];
    }
}
