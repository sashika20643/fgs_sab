<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\course;
use App\Subject;
use App\Result;
use App\User;
use App\Student;


use RealRashid\SweetAlert\Facades\Alert;

class ResultController extends Controller
{
    public function create(Request $request,$user_email,$semester = null)
    {
        $semester = $request->input('semester');
        $user = User::where('email',$user_email)->first();
        $student = $user->student;
        $subjects = $student->subjects;

    if ($semester) {

        $subjects = $subjects->where('semester', $semester);
    }

        return view('AR.results.show', compact('user', 'subjects'));

//         // Get the user ID from the request
//         // $user_email = $request->input('user_email');

//         // Retrieve the user by ID
//         $user = User::where('email',$user_email)->first();
//         $student = Student::where('stu_email',$user_email)->first();


//         // Check if the user exists
//         if (!$user) {
//             return redirect()->back()->with('error', 'User not found.');
//         }

//         // Retrieve all subjects for the user

// $courseId = $student->course_applied;

// $subjects = Subject::where('course_id', $courseId)->get();


//         // Retrieve the available courses for filtering
//         $courses = Course::all();

//         return view('AR.results.create', compact('user', 'subjects', 'courses'));
    }

    public function updateResult($user_id, $subject_id)
    {
        $user = User::find($user_id);
        $subject = Subject::find($subject_id);
        $resultValue = request('result');

        $result = Result::where('user_id', $user->id)
            ->where('subject_id', $subject->id)
            ->first();

        if ($result) {
            $result->result = $resultValue;
            $result->save();
        } else {
            $result = new Result;
            $result->user_id = $user->id;
            $result->subject_id = $subject->id;
            $result->result = $resultValue;
            $result->semester=$subject->semester;
            $result->save();
        }

        return redirect()->back()->with('success', 'Result updated successfully.');
    }

    // public function export(Request $request)
    // {
    //     $courseId = $request->input('course_id');
    //     $intake = $request->input('intake');

    //     $students = Student::with('course')
    //         ->where('course_applied', $courseId)
    //         ->where('intake', $intake)
    //         ->get();

    //     $export = new StudentsPaymentExport($students);

    //     return Excel::download($export, 'students_payment.xlsx');
    // }

}
