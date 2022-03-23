<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{


    use HasFactory;
    protected $guarded = ['id'];

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
}
