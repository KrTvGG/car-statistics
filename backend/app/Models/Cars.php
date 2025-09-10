<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    protected $table = 'cars';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'user_id',
        'guide_id',
        'car_year',
        'car_color',
        'vin_number',
        'car_number'
    ];

    protected $labels = [
        'name' => 'Марка автомобиля',
        'user_id' => 'id пользователя',
        'guide_id' => 'id справочника для этого автомобиля',
        'car_year' => 'Год выпуска автомобиля',
        'car_color' => 'Цвет автомобиля',
        'vin_number' => 'VIN-номер автомобиля',
        'car_number' => 'Номерной знак автомобиля'
    ];

    public function scopeFilter($query, array $filters)
    {
        return $query
            ->when($filters['name'] ?? null, fn($q, $name) => $q->where('name', 'like', "%$name%"))
            ->when($filters['car_year'] ?? null, fn($q, $car_year) => $q->where('car_year', $car_year))
            ->when($filters['vin_number'] ?? null, fn($q, $vin_number) => $q->where('vin_number', $vin_number))
            ->when($filters['car_number'] ?? null, fn($q, $car_number) => $q->where('car_number', $car_number));
    }
}
