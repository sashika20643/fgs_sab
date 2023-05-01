@extends('Admin.layout.layout')

@section('content')

<div class="d-flex justify-content-center align-items-center ps-5 " style="min-width:100%">
    <form action="{{route('studentfilter')}}" method="POST" class="mb-4">
        @csrf
        <div class="row align-items-center justify-content-center pb-3 pt-3 mb-3">
            <div class="col">


            </div>
            <div class="col">
                <div class="input-group">

                <select class="form-select" aria-label="Default select example" name="course">
                    <option selected value="0">All</option>
                    @foreach ($courses as $course )
                    <option value="{{$course->course_id}}">{{$course->course_title}}</option>
                    @endforeach




                  </select>

                </div>

            </div>

            <div class="col">
                <div class="input-group">

                <select class="form-select" aria-label="Default select example" name="intake">
                    <option selected value="0">Intake</option>
                    @foreach ($intakes as $intake )
                    <option value="{{$intake->name}}">{{$intake->name}}</option>
                    @endforeach




                  </select>

                </div>

            </div>
            <div class="col">
                <div class="input-group">
         <button type="submit" class="btn btn-success">
Filter
         </button>
                </div>
        </div>
        </form>
    <table class="table table-striped">
        <thead>
          <tr>
              <th>
                  Student name
                </th>

                <th>
            Email
                 </th>
                 <th>
                    NIC
                         </th>
            <th>
              Course
            </th>
        </th>
        <th>
       Intake
        </th>
            <th>
              Show more detais
            </th>
            <th>
             Delete
            </th>


          </tr>
        </thead>
        <tbody>
@foreach ($data as $student )
    <tr>
        <td>
{{$student->stu_name}}
        </td>
        <td>
            {{$student->stu_email}}
                    </td>
<td>
    {{$student->stu_nic_passport}}
</td>
<td>
    {{$student->course_title}}
</td>
<td>
    {{$student->intake}}
</td>
<td>
    <a href="{{route('Studentview',$student->stu_email)}}" class="btn btn-outline-success" >Show More</a>
</td>
<td>
    <a href="{{route('DeleteStudent',$student->stu_email)}}" class="btn btn-outline-danger" >Delete</a>
</td>
    </tr>
@endforeach

    </tbody>
      </table>



</div>

@endsection
