<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
