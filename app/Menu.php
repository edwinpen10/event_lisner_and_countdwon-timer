<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded=[];

    public function menu()
    {
        return $this->hasMany(Rolemenu::class);
    }
}
