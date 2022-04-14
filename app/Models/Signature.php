<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['employee'];

    // protected $fillable = [
    //     'name',	'department','part',
    // ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
