<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alphabet extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['paragraph', ];

    protected $fillable = [
        'alphabet', 'description',
    ];

    public function paragraph()
    {
        return $this->belongsTo(Paragraph::class);
    }

    public function violations()
    {
        return $this->hasMany(Violation::class);
    }
}
