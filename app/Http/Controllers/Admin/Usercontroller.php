<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\User;
use App\User_role;
use App\course;
use App\Intake;
use App\course_fee;
use App\Stu_fee;
use App\Payment;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;



class Usercontroller extends Controller
{
    public function Adduser(){
        $data=User_role::all();
 return view('Admin.adduser',compact('data'));


    }
    public function Addusertodb(Request $request){

        User::create(
            [

                'name'=> $request->name,
                'password'=>hash::make($request->pw),
                'role'=>$request->role,
                'email'=>$request->email





            ]
            );
            Alert::success('User added successfully',"You have added one user");

 return redirect()->back();
    }

    public function Addstudents(){
        $data =Student::whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('users')
                  ->whereRaw('students.stu_email = users.email');
        })
        ->get();

        $count=$data->unique('stu_email')->count();
        return view('Admin.addstudents',compact('count'));

           }

    public function AddstudentstoUser(){
        $data =Student::whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('users')
                  ->whereRaw('students.stu_email = users.email');
        })
        ->get();
$i=0;
        foreach ($data as $student) {
            $i++;
User::create(['name'=>$student->stu_name,
'email'=>$student->stu_email,
'password'=>$student->password,]);

        }
        Alert::success('Students added successfully',"You have added".$i." users");
         return redirect()->back();

           }

//----------all users-----------------
           function allstudents(){

            $data = DB::table('students')
            ->join('courses', 'students.course_applied', '=', 'courses.course_id')
            ->select('students.*', 'courses.course_title')
            ->get();
            $courses=course::all();
$intakes=Intake::all();

return view('Admin.allstudents',compact('data','courses','intakes'));

           }

    function studentfilter(Request $request){
        $data = DB::table('students')
        ->join('courses', 'students.course_applied', '=', 'courses.course_id')
        ->select('students.*', 'courses.course_title')->get();
if($request->course!='0'){
$data=$data->where("course_applied",$request->course);
}

if($request->intake){
    $data=$data->where("intake",$request->intake);
}

            $courses=course::all();
            $intakes=Intake::all();


return view('Admin.allstudents',compact('data','courses','intakes'));

           }



           function Studentview($email){
            $student = DB::table('students')
            ->join('courses', 'students.course_applied', '=', 'courses.course_id')
            ->select('students.*', 'courses.course_title')->where('stu_email',$email)
            ->first();

            return view('Admin.studentView',compact('student'));
           }

           function DeleteStudent($email){
            DB::table('students')->where('stu_email', $email)->delete();
            DB::table('users')->where('email', $email)->delete();
            Alert::success('Students deleted successfully',"");


            return redirect(route('allstudents'));
           }

           function allusers(){
            $data = DB::table('users')
            ->join('user_roles', 'users.role', '=', 'user_roles.roleid')
            ->select('users.*', 'user_roles.rolename')
            ->get();


return view('Admin.allusers',compact('data'));

           }
function StudentPaymentView($email){

    $state=1;
        $student=Student::where('stu_email',$email)->first();
        $feeses=course_fee::where('c_id',$student->course_applied)->get();

        $stu_fee=Stu_fee::where('s_id',$student->stu_id)->get();

        if($student->p_type==0){
            $state=0;

        }

            return view('Admin.stupayemntview',compact('student','feeses','stu_fee','state'));
           }

function changePType($email){


            $student=Student::where('stu_email',$email)->first();

          if($student->p_type==0){
            $student->p_type=1;
          }
          else{
            $student->p_type=0;
          }

          $student->save();

            return redirect()->back();
           }




}
