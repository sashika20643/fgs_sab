@extends('Admin.layout.layout')

@section('content')
<form action="{{ route('admin.subject.index') }}" method="GET">
    <label for="course_filter">Filter by Course:</label>
    <select name="course_filter" id="course_filter">
      <option value="">All Courses</option>
      @foreach($courses as $course)
        <option value="{{ $course->course_id }}" {{ $selectedCourse == $course->course_id ? 'selected' : '' }}>{{ $course->course_title }}</option>
      @endforeach
    </select>
    <button type="submit">Filter</button>
  </form>

<div class="container ps-5 " style="max-width:80%">
    <table class="table table-striped">
        <thead>
          <tr>
            <th>Course ID</th>
            <th>Subject Name</th>
            <th>Semester</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($subjects as $subject)
          <tr>
            <td>{{ $subject->course_id }}</td>
            <td>{{ $subject->subject_name }}</td>
            <td>{{ $subject->getSemesterName() }}</td>
                        <td>
              {{-- <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-outline-primary">Edit</a> --}}
            </td>
            <td>
              <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this subject?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

</div>
@endsection
