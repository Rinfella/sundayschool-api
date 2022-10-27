<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'start_month',
        'end_month',
        'honour_cutoff',
        'exam_full_mark',
        'total_number_of_sunday_schools',
    ];
}
