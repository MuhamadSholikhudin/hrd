<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliveryletter extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['violation', 'user'];

    public function violation()
    {
        return $this->belongsTo(Violation::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
