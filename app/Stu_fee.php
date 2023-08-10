<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stu_fee extends Model
{
    //

    // public function course_fee(): BelongsTo
    // {
    //     return $this->belongsTo(course_fee::class,'feeid','id');
    // }

    public function Stu_payment_fee ()
    {
        return $this->hasMany(Stu_payment_fee::class);

    }
    public function Course_fee ()
    {
        return $this->hasMany(Course_fee::class,'id','feeid');

    }
    public function student()
{
    return $this->belongsTo(Student::class, 'stu_id', 'id');
}
}
