<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Startwork extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $with = ['employee', 'job', 'department'];

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
