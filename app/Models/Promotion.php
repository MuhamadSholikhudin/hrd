<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $with = ['employee', 'job', 'department'];

    // protected $fillable = [
    //     'employee_id',	'job_id',	'department_id','', 'gender', 'date_of_birth',

    // ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
