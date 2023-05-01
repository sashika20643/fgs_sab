@extends('admin.layout.layout')

@section('content')

<div class="container ps-5 pe-5"  style="background-color: rgba(182, 188, 193, 0.5)">

    <form action="{{route('filterpayment')}}" method="POST" class="mb-4">
        @csrf
        <div class="row align-items-center justify-content-center pb-3 pt-3 mb-3">
            <div class="col">
                <div class="input-group">

                    <input type="date" name="date" value="00-00-00" class="form-control">
                  </div>


            </div>
            <div class="col">
                <div class="input-group">

                    <select class="form-select"  aria-label="Default select example" name="course">
                        <option selected value="0" >All courses</option>
                        @foreach ($courses as $course )
                        <option value="{{$course->course_id}}">{{$course->course_title}}</option>
                        @endforeach




                      </select>
                </div>

            </div>

            <div class="col">
                <div class="input-group">

                    <select class="form-select"  aria-label="Default select example" name="status">
                        <option selected value="0" >All Satus</option>

                        <option value="Approved">Approved</option>
                        <option value="pending">pending</option>





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
            <div class="col">
                <div class="input-group">
         <button type="submit" class="btn btn-success">
filter
         </button>
                </div>
        </div>
        </form>

<div class="table-responsive mt-5" >
    <table class="table table-striped">
      <thead>
        <tr>
            <th>
                Fee id
              </th>

              <th>
          User Name
               </th>
               <th>
                User nic
                     </th>
                     <th>
                       Intake
                             </th>
                     <th>
                        Course
                             </th>
          <th>
            Fee Catagories
          </th>
          <th>
            Slip
          </th>
          <th>
            Amount
          </th>
          <th>
           Date
          </th>
          <th>
            Status
          </th>

        </tr>
      </thead>
      <tbody>
@foreach ( $paymentdet as $fee )

@php
    $payment=$fee[0]
@endphp


        <tr>
               <td>
                {{$payment->payment_id}}
          </td>

          <td>
            {{$payment->payment->student[0]->stu_name}}
          </td>
          <td>
            {{$payment->payment->nic}}
          </td>
          <td>
            {{$payment->payment->student[0]->intake}}
          </td>
          <td>
            {{$payment->payment->course[0]->course_title}}
          </td>
          <td >
            <ul>

    @foreach ($fee as $stu )

@php
$stu_fee=$stu->stu_fee
@endphp



<li>

{{$stu_fee->course_fee[0]->fee_type}}
@if ($stu_fee->course_fee[0]->partial==1)


@if ($stu_fee->full_payment==0)
   - part I

@elseif($stu_fee->full_payment==1)
- Part II
@endif
( {{$stu_fee->course_fee[0]->fee/2}} )
@else
( {{$stu_fee->course_fee[0]->fee}} )
@endif


</li>



          @endforeach



        </ul>
        </td>
          <td>
            <a href="{{asset('slips/'.$payment->payment->slip)}}" target="blank"><img src="{{asset('slips/'.$payment->payment->slip)}}" alt=""></a>

          </td>
          <td>
            {{$payment->payment->Amount}}
          </td>
          <td>
            {{$payment->payment->Date}}
          </td>
          <td>
            @if($payment->payment->Status=="pending")
            <a href="{{route('admin.approve',$payment->payment->id)}}" class="btn btn-outline-warning">

            {{$payment->payment->Status}}
            </a>

            @else
            <button class="btn btn-outline-success">

                {{$payment->payment->Status}}
            </button>
            @endif
          </td>
        </tr>


        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
