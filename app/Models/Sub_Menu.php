<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_Menu extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['menu'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function methods()
    {
        return $this->hasMany(Sub_Menu::class);
    }

}
