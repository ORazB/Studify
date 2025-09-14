<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'classes';
    protected $primaryKey = 'class_id';

    protected $fillable = [
        'major',
    ];

    // One class has many students
    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }
}
