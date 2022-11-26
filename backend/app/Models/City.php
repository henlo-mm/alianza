<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    protected $fillable = [
        'states_id',
        'code',
        'name',
        'email',
    ];

    use HasFactory;
}
