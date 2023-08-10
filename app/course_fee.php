<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course_fee extends Model
{
    //
    public function Partial_fee()
    {
        return $this->hasMany(Partial_fee::class);
    }
    // public function Stu_fee()
    // {        return $this->belongsTo(Stu_fee::class,'feeid','id');

    // }
    public function stu_fee()
{
    return $this->hasMany(Stu_fee::class, 'feeid', 'id');
}
    public function Payment()
    {
        return $this->hasMany(Payment::class);
    }


}
