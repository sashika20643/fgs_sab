<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partial_fee extends Model
{
    public function course_fee()
    {
        return $this->belongsTo(Course_fee::class);
    }
}
