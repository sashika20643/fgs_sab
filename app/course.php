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
}
