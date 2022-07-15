<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProperyCategory extends Model
{
    use HasFactory;
    protected $table = 'property_category';
    protected $guarded = [];
}
