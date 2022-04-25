<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{


    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['job', 'department'];


    protected $fillable = [
        'number_of_employees',	'name',	'gender','place_of_birth', 'gender', 'date_of_birth',
    ];

    public function scopeFilter($query, array $filters){

        //Controller
        // if(request('search')){
        //     $employees->where('number_of_employees', 'like', '%' . request('search') . '%')
        //               ->orWhere('name', 'like', '%' . request('search') . '%');
        // }
        
        // if(request('search')){
        //     $employees->where('number_of_employees', 'like', '%' . request('search') . '%')
        //               ->orWhere('name', 'like', '%' . request('search') . '%');
        // }
    }
    


    public function investigations()
    {
        return $this->hasMany(Employee::class);
    }

    public function mutations()
    {
        return $this->hasMany(Employee::class);
    }

    public function promotions()
    {
        return $this->hasMany(Employee::class);
    }
    public function signatures()
    {
        return $this->hasMany(Employee::class);
    }

    public function demomotions()
    {
        return $this->hasMany(Employee::class);
    }
    
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function layoffs()
    {
        return $this->hasMany(Employee::class);
    }
}
