<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'department_id',
        'is_teacher_group',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function teacherAppointment()
    {
        return $this->hasOne(TeacherAppointment::class)->where('active', true);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
