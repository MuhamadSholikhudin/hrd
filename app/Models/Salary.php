<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $with = ['employee', 'job'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
