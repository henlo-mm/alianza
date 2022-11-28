<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

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

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function state()
    {
        return $this->belongsTo(State::class, 'states_id');
    }
    
}
