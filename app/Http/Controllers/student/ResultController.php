<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\course;
use App\Subject;
use App\Result;
use App\User;
use App\Student;

class ResultController extends Controller
{
    public function show(Request $request,$semester = null)
    {
        $semester = $request->input('semester');
        $user=\Auth::user();
        $student = $user->student;
        $subjects = $student->subjects;

    if ($semester) {

        $subjects = $subjects->where('semester', $semester);
    }

        return view('student.results', compact('user', 'subjects'));
    }
}
