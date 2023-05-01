<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\course_fee;
use App\Stu_fee;
use App\Payment;
use App\course;
use App\Intake;
use App\Stu_payment_fee;

use RealRashid\SweetAlert\Facades\Alert;


class AdminPaymentController extends Controller
{
    public function AdminPaymentView(){
    //    $payment= Payment::join('courses', 'payments.course_id', '=', 'courses.course_id')
    //     ->join('students', 'payments.s_id', '=', 'students.stu_id')
    //     ->select('payments.*', 'courses.*', 'students.*')
    //     ->get();
    //     $data = Stu_fee::join('course_fees', 'stu_fees.feeid', '=', 'course_fees.id')
    //     ->select('stu_fees.*', 'course_fees.*')
    //     ->get();
// $paymentdet=Stu_payment_fee::with( 'payment','Stu_fee')->get();
$paymentdet = Stu_payment_fee::with( 'payment.Student','Stu_fee.course_fee','payment.course')->get()->groupBy('payment_id')
             ;
//  return $paymentdet;
        $courses=course::all();
        $intakes=Intake::all();

        return view('Admin.payment',compact('courses','intakes','paymentdet'));

    }

    public function  paymentapprove($id){
        $payment=Payment::where('id',$id)->first();
        $payment->Status="Approved";
        $payment->save();
        $spayment=Stu_fee::where('p_id',$id)->first();
        $spayment->Status="Approved";
        $spayment->save();

        Alert::success('Payment Completed',"");
        return redirect(route('AdminPaymentView'));


    }

    public function filterpayment(Request $request){
        $paymentdet = Stu_payment_fee::with( 'payment.Student','Stu_fee.course_fee','payment.course')->get()->groupBy('payment_id');

        $payment= Payment::join('courses', 'payments.course_id', '=', 'courses.course_id')
        ->join('students', 'payments.s_id', '=', 'students.stu_id')
        ->select('payments.*', 'courses.*', 'students.*')
        ->get();
        if($request->course_id != 0){

         $paymentdet=$paymentdet->whereHas('payment', function ($query) {
            $query->where('id', $request->course_id);
        });

        }
        if($request->date){
            // $payment=$payment->where('Date',$request->date);
            $paymentdet=$paymentdet->whereHas('payment', function ($query) {
                $query->where('Date',$request->date);
            });
        }
        if($request->status != '0'){
            // $payment=$payment->where('Status',$request->status);
            $paymentdet=$paymentdet->whereHas('payment', function ($query) {
                $query->where('Status',$request->status);
            });

        }
        if($request->intake != '0'){
            // $payment=$payment->where('intake',$request->intake);
            $paymentdet=$paymentdet->whereHas('payment.student', function ($query) {
                $query->where('intake',$request->intake);
            });

        }

        // $data = Stu_fee::join('course_fees', 'stu_fees.feeid', '=', 'course_fees.id')
        // ->select('stu_fees.*', 'course_fees.*')
        // ->get();
        $courses=course::all();
        $intakes=Intake::all();
        return view('Admin.payment',compact('paymentdet','courses','intakes'));

    }


public function reports(){
    $courses=course::all();
    $intakes=Intake::all();

return view('AR.reports',compact('courses','intakes'));


}
public function getFees($course_id)
{
    $fees = course_fee::where('c_id', $course_id)->get();
    return response()->json($fees);
}

}
