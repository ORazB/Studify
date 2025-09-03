<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'student_id';

    protected $fillable = [
        'name',
        'age',
        'nis',
        'address',
        'phone_number',
        'foto',
        'class_id',
        'spp_id',
        'user_id',
    ];

    // Relationships
    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function spp()
    {
        return $this->belongsTo(Spp::class, 'spp_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
