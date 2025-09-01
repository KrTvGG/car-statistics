<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guides extends Model
{
    protected $table = 'guides';

    protected $primaryKey = 'id';

    protected $fillable = [
        'make',
        'model',
        'year',
        'body_type',
        'engine_type',
        'engine_capacity',
        'power',
        'transmission',
        'drive_type'
    ];

    protected $labels = [
        'make' => 'Производитель',
        'model' => 'Модель',
        'year' => 'Год выпуска',
        'body_type' => 'Тип кузова',
        'engine_type' => 'Тип двигателя',
        'engine_capacity' => 'Объем двигателя',
        'power' => 'Мощность',
        'transmission' => 'Тип трансмиссии',
        'drive_type' => 'Тип привода'
    ];

    public function scopeFilter($query, array $filters)
    {
        return $query
            ->when($filters['make'] ?? null, fn($q, $make) => $q->where('make', $make))
            ->when($filters['model'] ?? null, fn($q, $model) => $q->where('model', 'like', "%$model%"))
            ->when($filters['year'] ?? null, fn($q, $year) => $q->where('year', $year));
    }
}
