<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $with = ['employee', 'job'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
