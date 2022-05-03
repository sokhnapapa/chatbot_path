<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnSureResults extends Model
{
    protected $guarded = [];

    public function hivResults()
    {
        return $this->belongsTo('App\HIVResults','hiv_result_id');
    }
}
