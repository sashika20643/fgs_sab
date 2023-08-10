@extends('Admin.layout.layout')

@section('content')

<div class="container ps-5 " style="max-width:80%">
<!-- Filter Section -->
<form action="{{ route('admin.results.create',$user->email) }}" method="GET">
    <label for="course_filter">Filter by Course:</label>
    <select name="course_filter" id="course_filter">
      <option value="">All Courses</option>
      @foreach($courses as $course)
        <option value="{{ $course->course_id }}">{{ $course->course_title }}</option>
      @endforeach
    </select>

    <label for="semester_filter">Filter by Semester:</label>
    <select name="semester" id="semester">
        <option value="1-1">1st Year 1st Semester</option>
        <option value="1-2">1st Year 2nd Semester</option>
        <option value="2-1">2nd Year 1st Semester</option>
        <option value="2-2">2nd Year 2nd Semester</option>
        <option value="3-1">3rd Year 1st Semester</option>
        <option value="3-2">3rd Year 2nd Semester</option>
        <option value="4-1">4th Year 1st Semester</option>
        <option value="4-2">4th Year 2nd Semester</option>
      </select>

    <button type="submit">Filter</button>
  </form>

  <!-- Add Result Form -->
  <form action="{{ route('results.store') }}" method="POST">
    @csrf
    <label for="subject_id">Subject:</label>
    <select name="subject_id" id="subject_id">
      <option value="">Select Subject</option>
      @foreach($subjects as $subject)
        <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
      @endforeach
    </select>
    <br>

    <label for="result">Result:</label>
    <input type="text" name="result" id="result">
    <br>

    <button type="submit">Add Result</button>
  </form>



</div>

@endsection
