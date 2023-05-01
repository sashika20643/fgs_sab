@extends('student.layout.layout')

@section('content')

<div class="container ps-5 pe-5"  style="background-color: rgb(193, 189, 182,.2)">


<div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>

          <th>
            Fee Catagory
          </th>
          <th>
            Amount
          </th>
          <th>
            Status
          </th>

        </tr>
      </thead>
      <tbody>
@foreach ( $feeses as $fee )




        <tr>
            @if($state==0 || $fee->partial==0)
               <td>
                {{$fee->fee_type}}

          </td>


          <td>
            {{$fee->fee}}
          </td>

          @php
              $st=0;
          @endphp
          @foreach ($stu_fee as $stu )

    @if ($fee->id==$stu->feeid)
    @php
    $st=1;
    $status=$stu->status;
@endphp
@endif
          @endforeach
          @if ($st)
@if( $status=="pending")
          <td >
            <button class="btn btn-outline-warning">
                {{$status}}
            </button>

          </td>
@else
<td >
    <button class="btn btn-outline-success">
        {{$status}}
    </button>

  </td>
  @endif
@else

          <td>
            <a href="{{route('addpayment')}}" class="btn btn-outline-danger">
                yet to pay
            </a>

                </td>
          @endif


          @else

          {{-- partial  --}}

          <td>
            {{$fee->fee_type}}-part I

      </td>


      <td>
        {{$fee->fee/2}}
      </td>

      @php
          $st=0;
      @endphp
      @foreach ($stu_fee as $stu )

@if ($fee->id==$stu->feeid)
@php
$st=1;
$status=$stu->status;

@endphp




      @endif
      @endforeach
      @if ($st)
@if( $status=="pending")
      <td >
        <button class="btn btn-outline-warning">
            {{$status}}
        </button>

      </td>
@else
<td >
<button class="btn btn-outline-success">
    {{$status}}
</button>

</td>
@endif
      @else
      <td>
        <a href="{{route('addpayment')}}" class="btn btn-outline-danger">
            yet to pay
        </a>

            </td>
      @endif
        </tr>
        <tr>

          {{-- partial p2 --}}

          <td>
            {{$fee->fee_type}}-part II

      </td>


      <td>
        {{$fee->fee/2}}
      </td>

      @php
          $st=0;
      @endphp
      @foreach ($stu_fee as $stu )

@if ($fee->id==$stu->feeid && $stu->full_payment==1)
@php
$st=1;
$status=$stu->status;

@endphp




      @endif
      @endforeach
      @if ($st)
@if( $status=="pending" )
      <td >
        <button class="btn btn-outline-warning">
            {{$status}}
        </button>

      </td>
@else
<td >
<button class="btn btn-outline-success">
    {{$status}}
</button>

</td>
@endif
      @else
      <td>
        <a href="{{route('addpayment')}}" class="btn btn-outline-danger">
            yet to pay
        </a>

            </td>
      @endif
          @endif
        </tr>


        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
