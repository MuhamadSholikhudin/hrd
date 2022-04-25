<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layoff extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $with = ['employee', 'alphabet'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function alphabet()
    {
        return $this->belongsTo(Alphabet::class);
    }
}
