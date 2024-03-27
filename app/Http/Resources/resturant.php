<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\place as PlaceResource;
class resturant extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Name'=>$this->name,
        'Description Of Resturant'=>$this->description,
        'Address'=>$this->address,
        'E-Mail'=>$this->email,
        'place' => $this->place->name
        ];
    }
}
