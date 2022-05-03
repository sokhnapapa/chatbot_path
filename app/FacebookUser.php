<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacebookUser extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
