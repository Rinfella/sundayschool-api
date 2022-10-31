<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherAppointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'department_id',
        'group_id',
        'start_month',
        'active',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
