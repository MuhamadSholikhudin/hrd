<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function sub_menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function access_menus()
    {
        return $this->hasMany(Menu::class);
    }
}
