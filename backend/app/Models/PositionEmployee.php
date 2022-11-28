<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionEmployee extends Model
{
    use HasFactory;

    protected $table = 'poisitions_employee';

    protected $fillable = [
        'employee_id',
        'document',
        'area',
        'position_id',
        'rol_id',
        'chief_id',
    ];

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function chief()
    {
        return $this->belongsTo(Employee::class, 'chief_id');
    }
}
