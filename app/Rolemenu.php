<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rolemenu extends Model
{
    protected $guarded=[];

    public function menu()
    {
        return $this->belongsTo(Menu::class,'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   
}
