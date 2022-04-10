<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use Illuminate\Support\Collection;

class Paragraph extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['article'];

    protected $fillable = [
        'paragraph','article',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function alphabets()
    {
        return $this->hasMany(Paragraph::class);
    }
}
