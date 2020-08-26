<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    public function data()
    {
        return $this->belongsTo(User::class);
    }
}
