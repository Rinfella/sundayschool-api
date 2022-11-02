<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'session_id',
        'user_id',
        'group_id',
        'full_attendance',
        'exam_honours',
        'absent_count',
        'exam_marks',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
