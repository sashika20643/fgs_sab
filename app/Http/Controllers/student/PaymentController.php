<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\course_fee;
use App\Stu_fee;
use App\Payment;
use App\course;
use App\Student;
use App\Partial_fee;
use App\Stu_payment_fee;

use RealRashid\SweetAlert\Facades\Alert;



use Auth;
class PaymentController extends Controller
{
    public function addpayment(){
        $state=1;
        $student=Student::where('stu_email',Auth::user()->email)->first();
        $feeses=course_fee::with( 'Partial_fee')->where('c_id',$student->course_applied)->get();

if($student->p_type==0){
    // $feeses = $feeses->makeHidden('Partial_fee');
    $state=0;

}
        return view('student.pay',compact('feeses','state'));
    }

    public function pay(Request $request){
        $student=Student::where('stu_email',Auth::user()->email)->first();
        $feeses=course_fee::where('c_id',$student->course_applied)->get();
        $payment=new Payment;
        $payment->s_id=$student->stu_id;
        $payment->nic=$student->stu_nic_passport;
        $payment->course_id=$student->course_applied;
        $payment->Amount=$request->amount;
        $image=$request->slip;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->slip->move('slips',$imagename);
        $payment->slip=$imagename;
        $payment->Date=$request->date;
        $payment->save();
foreach ($feeses as $fee) {
    $fname=$fee->id;

    if($request->$fname){
if($fee->partial==1 && $fee->partial==1){
    $stu_fee=Stu_fee::where('s_id',$student->stu_id)->where('feeid',$fname);

    if($stu_fee->exists()){
        $stu_fee=$stu_fee->first();

        if($stu_fee->full_payment==0){
            $stu_fee->full_payment=1;
            $stu_fee->save();
                }
    }
    else{
        $stu_fee=new Stu_fee;

        $stu_fee->s_id=$student->stu_id;
        $stu_fee->p_id=$payment->id;
        $stu_fee->feeid=$fname;
        $stu_fee->full_payment=0;
        $stu_fee->save();

    }

}
else{
   $stu_fee=new Stu_fee;

        $stu_fee->s_id=$student->stu_id;
        $stu_fee->p_id=$payment->id;
        $stu_fee->feeid=$fname;

        $stu_fee->save();
}
$stu_payment_fee=new Stu_payment_fee;
$stu_payment_fee->payment_id=$payment->id;
$stu_payment_fee->stu_fee_id=$stu_fee->id;
$stu_payment_fee->save();


 }
}
Alert::success('Payment added successfully',"You have successfully paid rs ".$request->amount);


        return redirect()->back();
   }

    public function paymentdetail(){
        $state=1;
        $student=Student::where('stu_email',Auth::user()->email)->first();
        $feeses=course_fee::where('c_id',$student->course_applied)->get();

        $stu_fee=Stu_fee::where('s_id',$student->stu_id)->get();

        if($student->p_type==0){
            $state=0;

        }
        return view('student.paymentdetails',compact('feeses','stu_fee','state'));
    }
}
