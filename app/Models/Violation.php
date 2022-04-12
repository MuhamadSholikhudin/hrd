<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['alphabet', 'employee'];

    protected $fillable = [
        'date_of_violation', 'no_violation',
    ];

    public function alphabet()
    {
        return $this->belongsTo(Alphabet::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
