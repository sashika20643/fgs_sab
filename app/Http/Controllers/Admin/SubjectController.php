<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\course;
use App\Subject;
use RealRashid\SweetAlert\Facades\Alert;



class SubjectController extends Controller
{
    function Addsubjectview(){
        $courses=course::all();

return view('AR.subjects.subjects',compact('courses'));
    }


    public function storeSubject(Request $request)
{
    // Validate the form data
    $validatedData = $request->validate([
        'course_id' => 'required',
        'subject_name' => 'required',
        'semester' => 'required',
    ]);

    // Create a new subject instance
    $subject = new Subject();
    $subject->course_id = $validatedData['course_id'];
    $subject->subject_name = $validatedData['subject_name'];
    $subject->semester = $validatedData['semester'];

    // Save the subject to the database
    $subject->save();
    Alert::success('Subject Added',"");

    // Redirect or perform any additional actions as needed
    return redirect()->back()->with('success', 'Subject added successfully!');
}





public function index(Request $request)
{
    // Retrieve all subjects or filter by course if a course is selected
    $selectedCourse = $request->input('course_filter');
    $query = Subject::query();

    if ($selectedCourse) {
        $query->where('course_id', $selectedCourse);
    }

    $subjects = $query->get();

    // Retrieve the list of courses to use for the filter dropdown
    $courses = Course::all(); // Assuming you have a "Course" model

    return view('AR.subjects.allsubjects', compact('subjects', 'courses', 'selectedCourse'));
}

public function destroy(Subject $subject)
{
    // Delete the subject
    $subject->delete();

    // Redirect or perform any additional actions as needed
    return redirect()->route('admin.subjects.index')->with('success', 'Subject deleted successfully!');
}


}
