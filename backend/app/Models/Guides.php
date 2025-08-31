<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $make
 * @property string $model
 * @property int $year
 * @property float $engine_capacity
 * @property int $power
 * @property string|null $body_type
 * @property string|null $engine_type
 * @property string|null $transmission
 * @property string|null $drive_type
 */
class Guides extends Model
{
    protected $table = 'guides';

    protected $primaryKey = 'id';

    protected $fillable = [
        'make', // Производитель
        'model', // Модель
        'year', // Год выпуска
        'body_type', // Тип кузова
        'engine_type', // Тип двигателя
        'engine_capacity', // Объем двигателя
        'power', // Мощность
        'transmission', // Тип трансмиссии
        'drive_type' // Тип привода
    ];

    protected $casts = [
        'year' => 'integer',
        'engine_capacity' => 'float',
        'power' => 'integer',
    ];
}
