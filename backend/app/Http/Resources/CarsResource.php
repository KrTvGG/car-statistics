<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'user_id' => $this->user_id,
            'guide_id' => $this->guide_id,
            'car_year' => $this->car_year,
            'car_color' => $this->car_color,
            'vin_number' => $this->vin_number,
            'car_number' => $this->car_number
        ];
    }
}
