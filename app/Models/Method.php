<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['sub_menu', 'access_menus'];

    public function sub_menus()
    {
        return $this->belongsTo(Sub_menu::class);
    }
    public function access_menus()
    {
        return $this->belongsTo(Access_menu::class);
    }
}
