<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //

    public function Stu_payment_fee ()
    {
        return $this->hasMany(Stu_payment_fee::class);

    }

    public function Student ()
    {
        return $this->hasMany(Student::class,'stu_id','s_id');

    }
    public function course ()
    {
        return $this->hasMany(course::class,'course_id','course_id');

    }

}
