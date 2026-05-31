<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
   protected $fillable = [
    'employee_id', 'fullname', 'gender', 'email',
    'contact', 'position', 'department_id', 'status', 'date_hired'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}