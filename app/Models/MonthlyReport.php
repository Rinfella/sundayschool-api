<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_id',
        'month',
        'present',
        'absent',
        'total',
    ];
}
