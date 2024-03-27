<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\reservation as ReservationResource;

class reservation extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return  [
            'Reservation Date' => $this-> start_date,
            'Resturant' => $this->resturant->name,
            'Chairs Number' => $this->quantity,
            'User' => $this->user->name,
            'Notes Of Reservation' => $this->notes
                ];
    }
}
