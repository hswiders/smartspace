<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingTypes extends Model
{
    use HasFactory;
    protected $table = 'parking_types';
    protected $guarded = [];
}
