<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';
    protected $primaryKey = 'id';

    protected $fillable = [
        'student_id',
        'spp_id',
        'amount_paid',
        'payment_date',
    ];

    // Relationships
    public function student()
    {
        return $this->belongsTo(ClassModel::class,
        'student_id');
    }

    public function spp()
    {
        return $this->belongsTo(Spp::class, 
        'spp_id');
    }
}
