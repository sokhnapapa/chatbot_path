<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EligibilityTestQuestionAnswer extends Model
{
    //Table Name
    protected $table = 'eligibility_test_question_answers';
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;
}
