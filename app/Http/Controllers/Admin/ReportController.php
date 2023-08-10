<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\course_fee;
use App\Stu_fee;
use App\Payment;
use App\Student;

use App\course;
use App\Intake;
use App\Stu_payment_fee;
use Illuminate\Support\Facades\DB;
use App\Mail\MyBulkEmail;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

use App\Exports\StudentsPaymentExport;

use RealRashid\SweetAlert\Facades\Alert;

class ReportController extends Controller
{

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


public function generate(Request $request){


    // $course_id = $request->course; // example course ID
    // $fee_id = $request->fee; // example fee ID
    // $course=Course::where('course_id',$course_id)->first();
    // $fee=course_fee::find($fee_id);
    // $intake=$request->intake;

    // $students = DB::table('students')
    //                 ->leftJoin('stu_fees', function ($join) use ($fee_id) {
    //                     $join->on('students.stu_id', '=', 'stu_fees.s_id')
    //                          ->where('stu_fees.feeid', '=', $fee_id);
    //                 })
    //                 ->join('course_fees', 'students.course_applied', '=', 'course_fees.c_id')
    //                 ->join('courses', 'students.course_applied', '=', 'courses.course_id')
    //                 ->select('students.*','courses.*')
    //                 ->whereNull('stu_fees.id')
    //                 ->where('students.course_applied', '=', $course_id)->distinct()
    //                 ->get();

    // return  view('AR.showreport',compact('students','fee','intake','course'));










    $courseId = $request->course;
    $intake = $request->intake;
    $paymentStatus = $request->payment_status;

    $students = Student::with(['course', 'course.course_fee', 'course.course_fee.stu_fee'])
        ->where('course_applied', $courseId)
        ->where('intake', $intake)
        ->get();


    return view('AR.showreport', compact('students'));







}
function sendmail (Request $request) {

    $emailAddresses = $request->input('emailAddresses');
    $course = $request->course; // example course ID
    $fee = $request->fee;
    $total=$request->total;
    $intake=$request->intake;


    foreach ($emailAddresses as $email) {
        $student = Student::with(['course', 'course.course_fee', 'course.course_fee.stu_fee'])
        ->whereIn('stu_email', $emailAddresses)
        ->first();
    //   return($student);

      Mail::to($email)->send(new MyBulkEmail("Hello, $email!",$email,$fee,$course,$intake,$total,$student));
    }
    Alert::success('Emails sended',"");

    return redirect()->back()->with('success', 'Emails sent successfully');
  }



  public function users()
  {
      return Excel::download(new UsersExport(), 'users.xlsx');
  }
  public function export(Request $request)
{
    $courseId = $request->course;
    $intake = $request->intake;
    $paymentStatus = $request->payment_status;

    $students = Student::with(['course', 'course.course_fee', 'course.course_fee.stu_fee'])
        ->where('course_applied', $courseId)
        ->where('intake', $intake)
        ->get();
        $studentData = [];

        foreach ($students as $student) {
            $fees = [];
            foreach ($student->course->course_fee as $fee) {
                $fees[$fee->fee_type] = $fee->stu_fee->isNotEmpty() ? 'Paid' : 'Unpaid';
            }

            $studentData[] = array_merge([
                'Student_name' => $student->stu_name,
                'Email' => $student->stu_email,
                'NIC' => $student->stu_nic_passport,
                'Mobile'=>$student->stu_mobile_no,
                'Address1'=>$student->stu_add_line1,
                'Address2'=>$student->stu_add_line2,
                'Address3'=>$student->stu_add_line3,
                'City'=>$student->stu_add_city,

                'Course' => $student->course->course_title,
                'Intake' => $student->intake,

            ],$fees);
        }
        $feeTypes = [];

        // foreach ($students as $student) {
        //     foreach ($student->course->course_fee as $fee) {
        //         $feeTypes[$fee->id] = $fee->fee_type;
        //     }
        // }
        // return $students[0];
    $export = new StudentsPaymentExport($studentData);

    return Excel::download($export, 'students_payment.xlsx');
}


}
