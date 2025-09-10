<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $table = 'events';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name'
    ];

    protected $labels = [
        'name' => 'Наименование события',
    ];

    public function scopeFilter($query, array $filters)
    {
        return $query->when($filters['name'] ?? null, fn($q, $name) => $q->where('name', 'like', "%$name%"));
    }
}
