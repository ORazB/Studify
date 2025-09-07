<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    protected $table = 'spp';
    protected $primaryKey = 'spp_id';

    protected $fillable = [
        'year',
        'month',
        'nominal',
    ];

    // Relationships
}
