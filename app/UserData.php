<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    protected $table = 'user_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'document_type', 'document', 'address', 'phone', 'birthday',
    ];

    public function userData()
    {
        return $this->belongsTo(User::class);
    }
}
