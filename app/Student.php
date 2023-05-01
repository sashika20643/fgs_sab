<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //

    protected $primaryKey = 'stu_id';
    public $timestamps = false;
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'email', 'stu_email');
    }


    public function Payment()
    {
        return $this->belongsTo(Payment::class,'s_id','stu_id');

    }

}
