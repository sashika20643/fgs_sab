@extends('Admin.layout.layout')

@section('content')

<div class="container ps-5 " style="max-width:80%">
    <div class="card" style="background-color: rgb(214, 197, 166)">
        <div class="card-body">
          <h4 class="card-title">Add Subject</h4>
          <p class="card-description">
            fill form fields
          </p>

          <form action="{{route('admin.store')}}" method="POST">
            @csrf

            <label for="course_id">Course:</label>
            <select class="form-select"  name="course_id" id="course_id">
              @foreach($courses as $course)
                <option value="{{ $course->course_id }}">{{ $course->course_title }}</option>
              @endforeach
            </select>
            <br><br>

            <label for="subject_name">Subject Name:</label>
            <input type="text" class="form-control" name="subject_name" id="subject_name">
            <br><br>

            <label for="semester">Semester:</label>
            <select class="form-select"  name="semester" id="semester">
              <option value="1-1">1st Year 1st Semester</option>
              <option value="1-2">1st Year 2nd Semester</option>
              <option value="2-1">2nd Year 1st Semester</option>
              <option value="2-2">2nd Year 2nd Semester</option>
              <option value="3-1">3rd Year 1st Semester</option>
              <option value="3-2">3rd Year 2nd Semester</option>
              <option value="4-1">4th Year 1st Semester</option>
              <option value="4-2">4th Year 2nd Semester</option>
            </select>
            <br><br>

            <button class="btn btn-primary ms-3" type="submit">Add Subject</button>
          </form>

</div>
</div>

</div>

@endsection
