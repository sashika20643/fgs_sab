<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stu_payment_fee extends Model
{
    //

    public function Payment()
    {
        return $this->belongsTo(Payment::class);

    }

    public function Stu_fee()
    {
        return $this->belongsTo(Stu_fee::class);

    }
}
