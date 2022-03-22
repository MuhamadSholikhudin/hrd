<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investigation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['employee'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
