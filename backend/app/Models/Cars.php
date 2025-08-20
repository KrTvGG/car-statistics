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
}
