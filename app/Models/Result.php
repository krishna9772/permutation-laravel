<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'letter_num',
        'iteration',
    ];

}
