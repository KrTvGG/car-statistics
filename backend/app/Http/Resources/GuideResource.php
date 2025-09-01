<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GuideResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'make' => $this->make,
            'model' => $this->model,
            'year' => $this->year,
            'body_type' => $this->body_type,
            'engine_type' => $this->engine_type,
            'engine_capacity' => $this->engine_capacity,
            'power' => $this->power,
            'transmission' => $this->transmission,
            'drive_type' => $this->drive_type
        ];
    }
}
