<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class users_nodes extends Model
{
    public function Node()
    {
        return $this->belongsToMany('App\Node')
            ->withTimestamps();
    }
}
