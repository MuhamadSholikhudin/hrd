<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function investigations()
    {
        return $this->hasMany(Job::class);
    }

    public function mutations()
    {
        return $this->hasMany(Job::class);
    }

    public function promotions()
    {
        return $this->hasMany(Job::class);
    }
    public function demomotions()
    {
        return $this->hasMany(Job::class);
    }
    public function employees()
    {
        return $this->hasMany(Job::class);
    }
}
