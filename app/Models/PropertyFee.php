<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyFee extends Model
{
    use HasFactory;
    protected $table = 'property_fees';
    protected $guarded = [];
}
