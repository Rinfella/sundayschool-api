<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'name',
        'person_in_charge',
    ];
    protected $guarded = [
        //
    ];

}
