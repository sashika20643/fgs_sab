<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    //

    public function subject()
{
    return $this->belongsTo(Subject::class, 'subject_id', 'id');
}
}
