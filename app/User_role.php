<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_role extends Model
{
    //

    public function student()
{
    return $this->hasOne(Student::class, 'student_email', 'email');
}
}
