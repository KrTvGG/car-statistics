<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogEvents extends Model
{
    protected $table = 'log_events';

    protected $primaryKey = 'id';

    protected $fillable = [
        'event_id',
        'mileage',
        'car_id',
        'price',
        'description'
    ];
}
