<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    //

    public function Payment()
    {
        return $this->belongsTo(Payment::class,'course_id','course_id');

    }
    public function students()
{
    return $this->hasMany(Student::class, 'course_applied', 'course_id');
}

public function course_fee()
{
    return $this->hasMany(Course_fee::class, 'c_id', 'course_id');
}
}
