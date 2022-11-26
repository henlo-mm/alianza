<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'last_name',
        'document',
        'address',
        'phone',
        'states_id',
        'city_id',
    ];

    public function position()
    {
        return $this->hasMany(PositionEmployee::class, 'employee_id');
    }
}
