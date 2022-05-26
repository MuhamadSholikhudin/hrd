<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Access_menu extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['role', 'menu'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function methods()
    {
        return $this->hasMany(Method::class);
    }
}
