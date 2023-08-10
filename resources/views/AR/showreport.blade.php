@extends('Admin.layout.layout')

@section('content')
<div class="d-flex align-items-right " style="text-align: right; ">

    <form action="{{route('report.export')}}" type="Post">
        @csrf

        <input type="text" name="course" value="{{$students[0]->course->course_id}}" style="display:none">

               <input type="text" name="intake" value="{{$students[0]->intake}}" style="display:none">



               <button class="btn-success btn mr-3" type="submit">
                Generate report
                    </button>

            </form>

    <form method="POST" action="{{ route('report.sendmail') }}" style="ml-3">
        @csrf
        <input type="hidden" name="course" value="{{$students[0]->course->course_title}}">
        {{-- <input type="hidden" name="fee" value="{{$fee->fee_type}}"> --}}
        {{-- <input type="hidden" name="total" value="{{$fee->fee}}"> --}}
        <input type="hidden" name="intake" value="{{$students[0]->intake}}">




        @foreach($students as $student)
        <input type="hidden" name="emailAddresses[]" value="{{$student->stu_email}}">

        @endforeach
        <button class="btn btn-danger ms-3" type="submit" >
            Send Mail
                </button>
      </form>


</div>
<div class="d-flex justify-content-center align-items-center ps-5  " style="min-width:100%;over-flow:scroll">

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
        @foreach ($student->course->course_fee as $fee )
        <th>
            {{$fee->fee_type}}
        </th>
@endforeach

            <th>
              Show more detais
            </th>



          </tr>
        </thead>
        <tbody>
@foreach ($students as $student )
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
    {{$student->course->course_title}}
</td>

<td>
    {{$student->intake}}
</td>
@foreach ($student->course->course_fee as $fee )
    <td>
     @if ($fee->stu_fee->isNotEmpty())
        Paid
    @else
        Unpaid
    @endif</td>
@endforeach
<td>
    <a href="{{route('Studentview',$student->stu_email)}}" class="btn btn-outline-success" >Show More</a>
</td>
<td>
</td>
    </tr>
@endforeach

    </tbody>
      </table>




</div>

@endsection
