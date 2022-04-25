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
        'alphabet', 'description', 'layoffs',
    ];

    public function paragraph()
    {
        return $this->belongsTo(Paragraph::class);
    }

    public function violations()
    {
        return $this->belongsTo(Violation::class);
    }

    public function layoffs()
    {
        return $this->hasMany(Alphabet::class);
    }
}
