<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Profession extends Model
{

    //Allowed values
    protected $guarded = [];

    public function persons()
    {
        return $this->BelongsToMany('App\Person');
    }

}
